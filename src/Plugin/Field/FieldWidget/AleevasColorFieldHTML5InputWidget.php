<?php

/**
 * @file
 * Contains \Drupal\aleevas_experements\Plugin\Field\FieldWidget\AleevasColorFieldHTML5InputWidget.
 */

namespace Drupal\aleevas_experements\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @FieldWidget(
 *   id = "aleevas_color_field_html5_input_widget",
 *   module = "aleevas_color_field",
 *   label = @Translation("HTML5 Color Picker"),
 *   field_types = {
 *     "aleevas_color_field"
 *   }
 * )
 */
class AleevasColorFieldHTML5InputWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   *
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element += [
      '#type' => 'color',
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : '',
      '#size' => 7,
      '#maxlength' => 7,
      '#element_validate' => [
        [$this, 'hexColorValidation'],
      ],
    ];

    return ['value' => $element];
  }

  /**
   * {@inheritdoc}
   */
  public function hexColorValidation($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
      $form_state->setError($element, t('Color is not in HEX format'));
    }
  }

}
