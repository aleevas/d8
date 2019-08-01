<?php

namespace Drupal\aleevas_experiments\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Component\Utility\Html;

/**
 * Returns responses for aleevas_experiments routes.
 */
class AleevasAutocompleteController {

  /**
   * Callback for autocomplete route.
   *
   * {@inheritdoc}
   */
  public function autocomplete(Request $request) {
    $string = $request->query->get('q');
    $matches = [];

    if ($string) {
      // @todo remake with the EntityQuery.
      $query = \Drupal::database()->select('node_field_data', 'n')
        ->fields('n', array('nid', 'title'))
        ->condition('n.title', '%' . $string . '%', 'LIKE')
        ->range(0, 10);
      $result = $query->execute();

      foreach ($result as $row) {
        $value = Html::escape($row->title . ' (' . $row->nid . ')');
        $label = Html::escape($row->title);
        $matches[] = ['value' => $value, 'label' => $label];
      }
    }

    return new JsonResponse($matches);
  }

}
