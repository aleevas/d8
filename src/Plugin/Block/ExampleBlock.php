<?php

namespace Drupal\aleevas_experements\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "aleevas_experements_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("aleevas_experements")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
