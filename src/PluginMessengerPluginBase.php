<?php

namespace Drupal\aleevas_experements;

use Drupal\Component\Plugin\PluginBase;

/**
 * Base class for plugin_messenger plugins.
 */
abstract class PluginMessengerPluginBase extends PluginBase implements PluginMessengerInterface {

  /**
   * {@inheritdoc}
   */
  public function label() {
    // Cast the label to a string since it is a TranslatableMarkup object.
    return (string) $this->pluginDefinition['label'];
  }

  public function getId() {
    return (string) $this->pluginDefinition['id'];
  }

  public function getMessageType() {
    return 'status';
  }

  public function getMessage() {
    return '';
  }

  public function getPages() {
    return [];
  }
}
