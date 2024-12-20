<?php

namespace Drupal\environment_calculator\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\environment_calculator\Service\AssetCarbonCalculator;

/**
 * Controller for calculating and logging carbon emissions.
 */
class AssetCalculatorController extends ControllerBase {

  /**
   * The asset carbon calculator service.
   *
   * @var \Drupal\environment_calculator\Service\AssetCarbonCalculator
   */
  protected $assetCarbonCalculator;

  /**
   * Constructs an AssetCalculatorController object.
   *
   * @param \Drupal\environment_calculator\Service\AssetCarbonCalculator $assetCarbonCalculator
   *   The asset carbon calculator service.
   */
  public function __construct(AssetCarbonCalculator $assetCarbonCalculator) {
    $this->assetCarbonCalculator = $assetCarbonCalculator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('environment_calculator.asset_carbon_calculator')
    );
  }

  /**
   * Calculate and log carbon emissions for all assets.
   *
   * @return array
   *   A renderable array with the emissions calculation result.
   */
  public function logCarbonResults() {
    // Initialize total emissions.
    $totalEmissions = 0;

    // Load all assets.
    $storage = $this->entityTypeManager()->getStorage('asset');
    $assets = $storage->loadMultiple();

    // Calculate emissions for all assets dynamically.
    foreach ($assets as $asset) {
      $totalEmissions += $this->assetCarbonCalculator->calculateAssetEmission($asset);
    }

    // Update the observation log with the total emissions.
    $this->assetCarbonCalculator->updateObservationLog($totalEmissions);

    // Return a confirmation message.
    return [
      '#markup' => $this->t('The total carbon emissions have been updated successfully: @emissions kg CO2.', [
        '@emissions' => $totalEmissions,
      ]),
    ];
  }
}
