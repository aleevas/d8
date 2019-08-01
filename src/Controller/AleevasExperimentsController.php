<?php

namespace Drupal\aleevas_experiments\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for aleevas_experiments routes.
 */
class AleevasExperimentsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    return $this->formBuilder()->getForm('Drupal\aleevas_experiments\Form\AleevasExampleForm', '+3 (800) 123-45-67');
  }

}
