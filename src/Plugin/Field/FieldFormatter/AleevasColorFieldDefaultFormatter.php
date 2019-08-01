<?php

/**
 * @file
 * Contains \Drupal\aleevas_experiments\Plugin\Field\FieldFormatter\AleevasColorFieldDefaultFormatter.
 */

namespace Drupal\aleevas_experiments\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/** *
 * @FieldFormatter(
 *   id = "aleevas_color_field_default_formatter",
 *   label = @Translation("HEX color"),
 *   field_types = {
 *     "aleevas_color_field"
 *   }
 * )
 */
class AleevasColorFieldDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      $element[$delta] = [
        '#type' => 'markup',
        '#markup' => $item->value,
      ];
    }

    return $element;
  }

}
