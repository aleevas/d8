<?php

namespace Drupal\aleevas_experiments\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Defines plugin_messenger annotation object.
 *
 * @Annotation
 */
class PluginMessenger extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The human-readable name of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $title;

  /**
   * The description of the plugin.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $description;

}
