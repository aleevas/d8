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
    return $this->formBuilder()->getForm('Drupal\aleevas_experements\Form\AleevasExampleForm', '+3 (800) 123-45-67');
  }

}
