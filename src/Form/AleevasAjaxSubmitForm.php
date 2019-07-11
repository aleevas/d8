<?php

namespace Drupal\aleevas_experements\Form;

use Drupal\Component\Utility\EmailValidatorInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Renderer;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a aleevas_experements form.
 */
class AleevasAjaxSubmitForm extends FormBase {

  /**
   * The email validator.
   *
   * @var \Drupal\Component\Utility\EmailValidatorInterface
   *
   */
  protected $emailValidator;

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\Renderer
   */
  protected $renderer;

  /**
   * Constructs a new AleevasAjaxSubmitForm.
   *
   * @param \Drupal\Component\Utility\EmailValidatorInterface $email_validator
   *   The email validator.
   * @param \Drupal\Core\Render\Renderer $renderer
   *   The render service.
   */
  public function __construct(EmailValidatorInterface $email_validator,  Renderer $renderer) {
    $this->emailValidator = $email_validator;
    $this->renderer = $renderer;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('email.validator'),
      $container->get('renderer'),
      $container->get('messenger')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aleevas_experements_aleevas_ajax_submit';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['system_messages'] = [
      '#markup' => '<div id="form-system-messages"></div>',
      '#weight' => -100,
    ];

    $form['email'] = [
      '#title' => $this->t('Email'),
      '#type' => 'email',
      '#ajax' => [
        // If validation method is stored in other class you should use full name
        // like this: Drupal\modulename\ClassName::methodName.
        'callback' => '::validateEmailAjax',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => $this->t('Verifying email..'),
        ),
      ],
      '#suffix' => '<div class="email-validation-message"></div>'
    ];

    $form['select'] = [
      '#title' => $this->t('Select some fruit'),
      '#type' => 'select',
      '#options' => [
        'apple' => $this->t('Apple'),
        'banana' => $this->t('Banana'),
        'orange' => $this->t('Orange'),
      ],
      '#empty_option' => $this->t('- Select -'),
      '#required' => TRUE,
      '#ajax' => [
        'callback' => '::validateFruitAjax',
        'event' => 'change',
      ],
      '#prefix' => '<div id="fruit-selector">',
      '#suffix' => '</div>',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#name' => 'submit',
      '#value' => $this->t('Submit this form'),
      '#ajax' => [
        'callback' => '::ajaxSubmitCallback',
        'event' => 'click',
        'progress' => [
          'type' => 'throbber',
        ],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
//    $mail = $form_state->getValue('email');
//    if (substr($mail, -11) == 'example.com') {
//      $form_state->setErrorByName('email',
//        $this->t('This provider can lost our mail. Be care!'));
//    }
//    if (! $this->emailValidator->isValid($mail)) {
//      $form_state->setErrorByName('email',
//        $this->t('The email address that you entered is not a valid email address. Please enter a new one.'));
//    }
//    if (empty($form_state->getErrors())) {
//      $form_state->clearErrors();
//    }
//    if (! $form_state::hasAnyErrors()) {
//      $form_state->clearErrors();
//      $this->messenger->deleteAll();
//    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateEmailAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    $message = '';
    $mail = $form_state->getValue('email');
    if (substr($mail, -11) == 'example.com') {
      $message =  $this->t('This provider can lost our mail. Be care!');
    }
    if (! $this->emailValidator->isValid($mail)) {
      $message = $this->t('The email address that you entered is not a valid email address. Please enter a new one.');
    }
    // To remove the error if user was changed an entered value.
    $response->addCommand(new HtmlCommand('.email-validation-message', $message));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateFruitAjax(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();
    switch ($form_state->getValue('select')) {
      case 'apple':
        $style = ['border' => '2px solid green'];
        break;
      case 'banana':
        $style = ['border' => '2px solid yellow'];
        break;
      case 'orange':
        $style = ['border' => '2px solid orange'];
        break;
      default:
        $style = ['border' => '2px solid transparent'];
    }
    $response->addCommand(new CssCommand('#fruit-selector select', $style));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function ajaxSubmitCallback(array &$form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $message = [
      '#theme' => 'status_messages',
      '#message_list' => $this->messenger()->all(),
      '#status_headings' => [
        'status' => $this->t('Status message'),
        'error' => $this->t('Error message'),
        'warning' => $this->t('Warning message'),
      ],
    ];
    $messages = $this->renderer->render($message);
    $ajax_response->addCommand(new HtmlCommand('#form-system-messages', $messages));
    return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->deleteAll();
    $this->messenger()->addMessage('All ok!');
  }
}
