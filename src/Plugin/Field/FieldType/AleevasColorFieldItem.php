<?php

/**
 * @file
 * Contains Drupal\aleevas_experements\Plugin\Field\FieldType\AleevasColorFieldItem.
 */

namespace Drupal\aleevas_experements\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *   id = "aleevas_color_field",
 *   label = @Translation("My color field"),
 *   module = "aleevas_experements",
 *   description = @Translation("Custom color picker."),
 *   category = @Translation("Color"),
 *   default_widget = "aleevas_color_field_html5_input_widget",
 *   default_formatter = "aleevas_color_field_default_formatter"
 * )
 */
class AleevasColorFieldItem extends FieldItemBase {

  /**
   * {@inheritdoc}
   *
   * @see https://www.drupal.org/node/159605
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   *
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Hex color'));

    return $properties;
  }
}
