<?php

namespace Drupal\aleevas_experements\Plugin\Filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\filter\FilterProcessResult;
use Drupal\filter\Plugin\FilterBase;

/**
 * Provides a 'Aleevas filter' filter.
 *
 * @Filter(
 *   id = "ae_filter",
 *   title = @Translation("Aleevas filter"),
 *   type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *   settings = {
 *     "search" = "Alexey",
 *     "replace" = "The Big Brother",
 *   },
 *   weight = -10
 * )
 */
class AeFilter extends FilterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['search'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search'),
      '#default_value' => $this->settings['search'],
      '#maxlength' => 1024,
      '#size' => 250,
    ];

    $form['replace'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Replace'),
      '#default_value' => $this->settings['replace'],
      '#maxlength' => 1024,
      '#size' => 250,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function process($text, $langcode) {
    $text = str_replace($this->settings['search'], $this->settings['replace'], $text);
    return new FilterProcessResult($text);
  }

  /**
   * {@inheritdoc}
   */
  public function tips($long = FALSE) {
    return $this->t('Some filter tips here.');
  }

}
