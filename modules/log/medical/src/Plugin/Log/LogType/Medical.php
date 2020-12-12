<?php

namespace Drupal\farm_medical\Plugin\Log\LogType;

use Drupal\farm_field\Plugin\Log\LogType\FarmLogType;

/**
 * Provides the medical log type.
 *
 * @LogType(
 *   id = "medical",
 *   label = @Translation("Medical"),
 * )
 */
class Medical extends FarmLogType {

  /**
   * {@inheritdoc}
   */
  public function buildFieldDefinitions() {
    $fields = parent::buildFieldDefinitions();

    // Veterinarian.
    $options = [
      'type' => 'string',
      'label' => 'Veterinarian',
      'description' => 'If a veterinarian was involved, enter their name here.',
      'weight' => [
        'form' => -40,
        'view' => -40,
      ],
    ];
    $fields['vet'] = \Drupal::service('farm_field.factory')->bundleFieldDefinition($options);

    return $fields;
  }

}
