<?php

namespace Drupal\environment_calculator\Service;

use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Service for calculating carbon emissions from farm assets.
 */
class AssetCarbonCalculator {

  protected $entityTypeManager;

  /**
   * Constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager service.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * Calculate emissions adjustment for a single asset.
   */
  public function calculateAssetEmission($asset) {
    $type = $asset->get('type')->target_id ?? 'unknown';

    $emission_factors = [
      'animal' => 1000,   // Average emission per animal.
      'equipment' => 500, // Average emission per equipment.
      'land' => -100,     // Average sequestration per land.
    ];

    return $emission_factors[$type] ?? 0;
  }

  /**
   * Update the observation log with the new total emissions.
   */
  /**
 * Update the observation log with the total carbon emissions.
 */
public function updateObservationLog($adjustment) {
    $storage = $this->entityTypeManager->getStorage('log');
    $observations = $storage->loadByProperties([
      'type' => 'observation',
      'name' => 'Total Carbon Emissions',
    ]);
  
    $current_emissions = 0;
  
    // Load existing log or create a new one.
    if ($observations) {
      $observation = reset($observations);
      // Extract existing emissions from the 'notes' field.
      $current_emissions = (float) $observation->get('notes')->value ?? 0;
    } 
    else {
      // Create a new observation log if it doesn't exist.
      $observation = $storage->create([
        'type' => 'observation',
        'name' => 'Total Carbon Emissions',
      ]);
    }
  
    // Update the total emissions and store it in the 'notes' field.
    $new_value = $current_emissions + $adjustment;
    $observation->set('notes', 'Total Carbon Emissions: ' . $new_value);
    $observation->save();
  }

} 
  
