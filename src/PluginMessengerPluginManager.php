<?php

namespace Drupal\aleevas_experements;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * PluginMessenger plugin manager.
 */
class PluginMessengerPluginManager extends DefaultPluginManager {

  /**
   * Constructs PluginMessengerPluginManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/PluginMessenger',
      $namespaces,
      $module_handler,
      'Drupal\aleevas_experements\PluginMessengerInterface',
      'Drupal\aleevas_experements\Annotation\PluginMessenger'
    );
    $this->alterInfo('plugin_messenger_info');
    $this->setCacheBackend($cache_backend, 'plugin_messenger_plugins');
  }

}
