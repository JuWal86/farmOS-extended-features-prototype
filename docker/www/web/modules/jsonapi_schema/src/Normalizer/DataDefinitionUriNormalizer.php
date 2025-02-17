<?php

namespace Drupal\jsonapi_schema\Normalizer;

use Drupal\Core\TypedData\DataDefinitionInterface;

/**
 * Data definition normalizer.
 */
class DataDefinitionUriNormalizer extends DataDefinitionNormalizer {

  /**
   * {@inheritdoc}
   */
  protected $supportedDataTypes = ['uri'];

  /**
   * {@inheritdoc}
   */
  protected function extractPropertyData(DataDefinitionInterface $property, array $context = []) {
    $value = parent::extractPropertyData($property);
    $value['type'] = 'string';
    $value['format'] = 'uri';
    return $value;
  }

}
