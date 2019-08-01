<?php

namespace Drupal\aleevas_experiments;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Defines a service provider for the aleevas_experiments module.
 */
class AleevasExperimentsServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
//    $container->register('aleevas_experiments.subscriber', 'Drupal\aleevas_experiments\EventSubscriber\AleevasExperimentsSubscriber')
//      ->addTag('event_subscriber')
//      ->addArgument(new Reference('entity_type.manager'));
  }

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
//    $definition = $container->getDefinition('aleevas_experiments.random_message');
//    $definition->setClass('Drupal\aleevas_experiments\NewAleevasRandomMessage');
  }

}
