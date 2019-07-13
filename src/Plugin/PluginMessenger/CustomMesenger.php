<?php

namespace Drupal\aleevas_experements\Plugin\PluginMessenger;

use Drupal\aleevas_experements\PluginMessengerPluginBase;

/**
 * Plugin implementation of the plugin_messenger.
 *
 * @PluginMessenger(
 *   id = "custom_plugin_1",
 *   label = @Translation("First custom plugin"),
 *   description = @Translation("The description for the first custom plugin.")
 * )
 */
class CustomMesenger extends PluginMessengerPluginBase {
  /**
   * Return a message from this plugin.
   */
  public function getMessage() {
    return 'This is message from Example #1';
  }
}
