<?php

namespace Drupal\aleevas_experiments\Plugin\PluginMessenger;

use Drupal\aleevas_experiments\PluginMessengerPluginBase;

/**
 * Plugin implementation of the plugin_messenger.
 *
 * @PluginMessenger(
 *   id = "custom_plugin_with_pages",
 *   label = @Translation("First custom plugin witn pages"),
 *   description = @Translation("The description for the first custom plugin.")
 * )
 */
class CustomMesengerWithPages extends PluginMessengerPluginBase {
  /**
   * Return a message from this plugin.
   */
  public function getMessage() {
    return 'This is message from plugin with set pages settings';
  }
  /**
   * {@inheritdoc}
   */
  public function getMessageType() {
    return 'error';
  }

  /**
   * {@inheritdoc}
   */
  public function getPages() {
    return [
      '/node/*',
      '/contact',
      '<front>',
    ];
  }
}
