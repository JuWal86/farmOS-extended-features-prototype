<?php

namespace Drupal\mock_sensors\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\State\StateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for Mock Sensor Data.
 */
class MockSensorsController extends ControllerBase {

  protected $state;

  /**
   * Constructs a new controller instance.
   */
  public function __construct(StateInterface $state) {
    $this->state = $state;
  }

  /**
   * Dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('state'));
  }

  /**
   * Displays the mock sensor data.
   */
  public function display() {
    $sensor_data = $this->getMockSensorData();
  
    $build = [
      '#theme' => 'item_list',
      '#title' => 'Mock Sensor Data Over Time',
      '#items' => [],
      '#cache' => ['max-age' => 0], // Disable caching for real-time updates.
    ];
  
    foreach ($sensor_data as $timestamp => $values) {
      $build['#items'][] = "{$timestamp}: Temperature: {$values['temperature']}, Soil Moisture: {$values['moisture']}, Crop Height: {$values['height']}";
    }
  
    // Attach the JS library for real-time refresh.
    $build['#attached']['library'][] = 'mock_sensors/mock_sensors_js';
  
    return $build;
  }
  
  
  

  /**
   * Generates or fetches mock sensor data with alerts and resets.
   */
  private function getMockSensorData() {
    // Fetch current sensor data and alert states.
    $data = $this->state->get('mock_sensor_data', []);
    $alert_active = $this->state->get('mock_alert_active', FALSE);
    $alert_time = $this->state->get('mock_alert_time', 0);
    $alert_field = $this->state->get('mock_alert_field', ''); // Track the field that triggered the alert.
  
    // Define healthy thresholds.
    $healthy_values = [
      'temperature' => 25.0,
      'moisture' => 70.0,
      'height' => 1.00, // 1.00 m is the starting healthy crop height.
    ];
  
    // Start moisture at 31% if data is empty.
    if (empty($data)) {
      $data[date('Y-m-d H:i:s')] = [
        'temperature' => number_format(25.0, 1) . '°C',
        'moisture' => number_format(31.0, 1) . '%',
        'height' => number_format(1.0, 3) . 'm',
      ];
      $this->state->set('mock_sensor_data', $data);
    }
  
    // If an alert has been active for 30 seconds, reset the specific value.
    if ($alert_active && (time() - $alert_time) >= 30) {
      $timestamp = date('Y-m-d H:i:s');
      $last_entry = end($data);
  
      // Reset only the problematic field to its healthy threshold.
      $new_entry = $last_entry; // Copy previous values.
      if ($alert_field === 'temperature') {
        $new_entry['temperature'] = number_format($healthy_values['temperature'], 1) . '°C';
      }
      if ($alert_field === 'moisture') {
        $new_entry['moisture'] = number_format($healthy_values['moisture'], 1) . '%';
      }
      if ($alert_field === 'height') {
        $new_entry['height'] = number_format($healthy_values['height'], 3) . 'm';
      }
  
      // Save reset values and clear alert state.
      $data[$timestamp] = $new_entry;
      $this->state->set('mock_alert_active', FALSE);
      $this->state->set('mock_alert_field', ''); // Clear alert field.
      \Drupal::messenger()->addMessage(t("Sensor values for {$alert_field} have recovered to healthy levels."), 'status');
    } else {
      // Generate new sensor values.
      $last_entry = end($data);
      $last_temperature = (float) $last_entry['temperature'];
      $last_moisture = (float) $last_entry['moisture'];
      $last_height = (float) $last_entry['height'];
  
      $new_temperature = max(min($last_temperature + rand(-5, 5) * 0.1, 40), 20);
      $new_moisture = max($last_moisture - 0.5, 0);
      $new_height = min($last_height + 0.1, 2.0);
  
      $alerts = [];
      $alert_field_to_set = '';
  
      // Check for alerts and identify the problematic field.
      if ($new_temperature > 35 && !$alert_active) {
        $alerts[] = "High Temperature Alert: {$new_temperature}°C!";
        $alert_field_to_set = 'temperature';
      }
      if ($new_moisture < 30 && !$alert_active) {
        $alerts[] = "Soil Moisture Too Low: {$new_moisture}%!";
        $alert_field_to_set = 'moisture';
      }
      if ($new_height > 1.5 && !$alert_active) {
        $alerts[] = "Crop Height Ready for Harvest: {$new_height}m!";
        $alert_field_to_set = 'height';
      }
  
      // Trigger alerts if thresholds are breached.
      if (!empty($alerts)) {
        \Drupal::messenger()->addMessage(t(implode(' ', $alerts)), 'error');
        $this->state->set('mock_alert_active', TRUE);
        $this->state->set('mock_alert_time', time());
        $this->state->set('mock_alert_field', $alert_field_to_set);
      }
  
      // Add the new data entry.
      $data[date('Y-m-d H:i:s')] = [
        'temperature' => number_format($new_temperature, 1) . '°C',
        'moisture' => number_format($new_moisture, 1) . '%',
        'height' => number_format($new_height, 3) . 'm',
      ];
    }
  
    // Keep only the last 10 values.
    if (count($data) > 10) {
      $data = array_slice($data, -10, null, TRUE);
    }
  
    $this->state->set('mock_sensor_data', $data);
    return $data;
  }
  
  
  
  
  
  
}
