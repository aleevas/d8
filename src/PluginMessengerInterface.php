<?php

namespace Drupal\aleevas_experements;

/**
 * Interface for plugin_messenger plugins.
 */
interface PluginMessengerInterface {

  /**
   * Returns the translated plugin label.
   *
   * @return string
   *   The translated title.
   */
  public function label();
  /**
   * Returns the ID of plugin.
   *
   * @return string
   *   The ID of plugin.
   */
  public function getId();
  /**
   * Returns the Message Type of system message.
   *
   * @return string
   *   The type of message.
   */
  public function getMessageType();
  /**
   * Returns the Message itself.
   *
   * @return string
   *   The message.
   */
  public function getMessage();
  /**
   * Returns the list of pages on which we should display a messages.
   *
   * @return array
   *   The list of pages.
   */
  public function getPages();

}
