<?php

namespace Drupal\farm_timeline\Plugin\DataType;

use Drupal\Core\TypedData\ComplexDataInterface;
use Drupal\Core\TypedData\Plugin\DataType\Map;

/**
 * Timeline row data type.
 *
 * @DataType(
 *   id = "farm_timeline_row",
 *   label = @Translation("Timeline row"),
 *   description = @Translation("Data definition for a timeline row."),
 *   definition_class = "\Drupal\farm_timeline\TypedData\TimelineRowDefinition"
 * )
 */
class TimelineRow extends Map implements ComplexDataInterface {

  /**
   * {@inheritdoc}
   */
  public function setValue($values, $notify = TRUE) {
    if (isset($values) && !is_array($values)) {
      throw new \InvalidArgumentException("Invalid values given. Values must be represented as an associative array.");
    }

    // Set default values.
    $values += [
      'draggable' => FALSE,
      'resizable' => FALSE,
      'expanded' => FALSE,
    ];
    parent::setValue($values);
  }

}
