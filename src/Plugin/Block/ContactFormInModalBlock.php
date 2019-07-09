<?php

namespace Drupal\aleevas_experements\Plugin\Block;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a contact form in modal block.
 *
 * @Block(
 *   id = "aleevas_experements_contact_form_in_modal",
 *   admin_label = @Translation("Contact form in modal"),
 *   category = @Translation("Custom")
 * )
 */
class ContactFormInModalBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The bundle information service.
   *
   * @var \Drupal\Core\Entity\EntityTypeBundleInfoInterface
   */
  protected $bundleInfo;

  /**
   * Creates an instance of ModerationStateFilter.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeBundleInfoInterface $bundle_info) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->bundleInfo = $bundle_info->getBundleInfo('contact_message');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('entity_type.bundle.info')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'form' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();
    $form['#attached']['library'][] = 'aleevas_experements/modal_form.library';

    $form['form'] = [
      '#type' => 'select',
      '#title' => $this->t('Select form to open in modal'),
      '#options' => $this->getContactForms(),
      '#empty_option' => $this->t('- Select -'),
      '#default_value' => $config['form'] ? $config['form'] : FALSE,
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['form'] = $form_state->getValue('form');
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'administer blocks');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    return [
      '#type' => 'link',
      '#title' => 'Contact with me!',
      '#url' => Url::fromRoute('entity.contact_form.canonical', ['contact_form' => $config['form']]),
      '#options' => [
        'attributes' => [
          'class' => ['use-ajax', 'button', 'button--small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode([
            'width' => 700,
          ]),
        ],
      ],
      '#attached' => ['library' => ['core/drupal.dialog.ajax']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  private function getContactForms() {
    $forms = [];
    foreach ($this->bundleInfo as $k => $v) {
      $forms[$k] = $v['label'];
    }
    unset($forms['personal']);
    return $forms;
  }
}
