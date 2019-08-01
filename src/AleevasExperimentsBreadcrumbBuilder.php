<?php

namespace Drupal\aleevas_experiments;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Link;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\NodeInterface;

/**
 * Provides a breadcrumb builder for articles.
 */
class AleevasExperimentsBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $route_match) {
    $node = $route_match->getParameter('node');
    return $node instanceof NodeInterface && $node->getType() == 'article';
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $breadcrumb = new Breadcrumb();

    $links[] = Link::createFromRoute($this->t('Home'), '<front>');
    // Articles page is a view.
    $links[] = Link::createFromRoute($this->t('Articles'), 'entity.node.canonical', ['node' => 1]);

    $node = $route_match->getParameter('node');
    $links[] = Link::createFromRoute($node->label(), '<none>');

    $breadcrumb->addCacheContexts(['url.path']);
    $breadcrumb->setLinks($links);

    return $breadcrumb;
  }

}
