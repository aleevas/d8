<?php

namespace Drupal\aleevas_experements\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for aleevas_experements routes.
 */
class AleevasExperementsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
