<?php
/**
 * @file
 * Contains \Drupal\aleevas_experements\Form\AleevasQueueNodeForm.
 */

namespace Drupal\aleevas_experements\Form;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Queue\QueueInterface;

/**
 * Provides a aleevas_experements form.
 */
class AleevasQueueNodeForm extends FormBase {

  /**
   * The queue object.
   *
   * @var \Drupal\Core\Queue\QueueInterface
   */
  protected $queue;

  /**
   * The user storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $userStorage;

  /**
   * Constructs a new AleevasQueueNodeForm.
   *
   * @param \Drupal\Core\Queue\QueueInterface $queue
   *   The queue object.
   * @param \Drupal\Core\Entity\EntityStorageInterface $user_storage
   *   The user storage.
   */
  public function __construct(QueueInterface $queue, EntityStorageInterface $user_storage) {
    $this->queue = $queue;
    $this->userStorage = $user_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('queue')->get('aleevas_mass_sending', TRUE),
      $container->get('entity.manager')->getStorage('user')
    );
  }
  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'aleevas_queue_node_form';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if ($number_of_items = $this->queue->numberOfItems()) {
      $form['info_text'] = [
        '#type' => 'markup',
        '#markup' => new TranslatableMarkup("<b>This queue already run, items for processing: @number</b>", [
          '@number' => $number_of_items,
        ]),
      ];

      $form['delete'] = [
        '#type' => 'submit',
        '#value' => $this->t('Cancel current queue'),
        '#disable' => TRUE,
      ];

    }
    else {
      $form['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Create node for each user'),
        '#disable' => TRUE,
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getTriggeringElement()['#id'] == 'edit-delete') {
      $this->queue->deleteQueue();
    }
    else {
      $result = $this->getUsers();
      $this->queue->createQueue();
      // We didn't get any data from DB.
      if (is_null($result)) {
        $this->queue->deleteQueue();
        $this->messenger()->addError(
          $this->t(
            'In the database not stored any proper data. Please check a data.'
          )
        );
      }
      foreach ($result as $row) {
        $this->queue->createItem([
          'uid' => $row->uid,
          'name' => $row->name,
        ]);
      }
    }
  }

  /**
   * Help function.
   * Getting nodes from DB.
   *
   * @return mixed
   */
  private function getUsers() {
    return  $query = \Drupal::database()->select('users_field_data', 'u')
      ->fields('u', ['uid', 'name'])
      ->condition('u.status', 1)->execute();
  }

}
