<?php

namespace Drupal\environment_calculator\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class EnvironmentalCalculatorForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'environmental_calculator_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Create tabs for category selection (Livestock, Crops, Machines, Energy).
    $form['categories'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Calculation Categories'),
    ];

    // Livestock Tab.
    $form['livestock'] = [
      '#type' => 'details',
      '#title' => $this->t('Livestock'),
      '#group' => 'categories',
    ];
    $form['livestock']['livestock_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Livestock Type'),
      '#options' => [
        '' => $this->t('- Select -'),
        'cattle' => $this->t('Cattle'),
        'poultry' => $this->t('Poultry'),
        'sheep' => $this->t('Sheep'),
      ],
    ];
    $form['livestock']['livestock_count'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of Livestock'),
    ];

    // Crops Tab.
    $form['crops'] = [
      '#type' => 'details',
      '#title' => $this->t('Crops'),
      '#group' => 'categories',
    ];
    $form['crops']['crop_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Crop Type'),
      '#options' => [
        '' => $this->t('- Select -'),
        'wheat' => $this->t('Wheat'),
        'corn' => $this->t('Corn'),
        'barley' => $this->t('Barley'),
      ],
    ];
    $form['crops']['field_area'] = [
      '#type' => 'number',
      '#title' => $this->t('Field Area (hectares)'),
    ];

    // Machines Tab.
    $form['machines'] = [
      '#type' => 'details',
      '#title' => $this->t('Machines'),
      '#group' => 'categories',
    ];
    $form['machines']['machine_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Machine Type'),
      '#options' => [
        '' => $this->t('- Select -'),
        'tractor' => $this->t('Tractor'),
        'harvester' => $this->t('Harvester'),
        'plow' => $this->t('Plow'),
      ],
    ];
    $form['machines']['resource_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Resource Used'),
      '#options' => [
        '' => $this->t('- Select -'),
        'diesel' => $this->t('Diesel'),
        'electric' => $this->t('Electric'),
        'gasoline' => $this->t('Gasoline'),
      ],
    ];
    $form['machines']['usage_hours'] = [
      '#type' => 'number',
      '#title' => $this->t('Usage Hours Per Day'),
    ];

    // Overall Energy Tab.
    $form['overall_energy'] = [
      '#type' => 'details',
      '#title' => $this->t('Overall Energy'),
      '#group' => 'categories',
    ];
    $form['overall_energy']['daily_energy'] = [
      '#type' => 'number',
      '#title' => $this->t('Daily Energy Usage (kWh)'),
    ];

    // Submit Button.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Calculation'),
    ];

    return $form;
  }

  /**
   * Redirect to Add Calculation.
   */
  public function redirectToAddCalculation(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('<front>'); // Replace with the actual path to the form.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Initialize emissions to zero.
    $emissions = 0;
  
    // Collect values for the log.
    $log_values = [];
  
    // Check and include livestock calculation.
    $livestock_type = $form_state->getValue('livestock_type');
    $livestock_count = $form_state->getValue('livestock_count');
    if (!empty($livestock_count)) {
      $emissions += $livestock_count * 1.5;
      $log_values['Livestock'] = $this->t('@type: @count', [
        '@type' => $livestock_type ?: $this->t('Not specified'),
        '@count' => $livestock_count,
      ]);
    }
  
    // Check and include crops calculation.
    $crop_type = $form_state->getValue('crop_type');
    $field_area = $form_state->getValue('field_area');
    if (!empty($field_area)) {
      $emissions += $field_area * 0.75;
      $log_values['Crops'] = $this->t('@type: @area hectares', [
        '@type' => $crop_type ?: $this->t('Not specified'),
        '@area' => $field_area,
      ]);
    }
  
    // Check and include machines calculation.
    $machine_type = $form_state->getValue('machine_type');
    $resource_type = $form_state->getValue('resource_type');
    $usage_hours = $form_state->getValue('usage_hours');
    if (!empty($usage_hours)) {
      $emissions += $usage_hours * 2;
      $log_values['Machines'] = $this->t('@type (@resource): @hours hrs', [
        '@type' => $machine_type ?: $this->t('Not specified'),
        '@resource' => $resource_type ?: $this->t('Not specified'),
        '@hours' => $usage_hours,
      ]);
    }
  
    // Check and include energy calculation.
    $daily_energy = $form_state->getValue('daily_energy');
    if (!empty($daily_energy)) {
      $emissions += $daily_energy * 1.2;
      $log_values['Energy'] = $this->t('Daily Energy Usage: @energy kWh', [
        '@energy' => $daily_energy,
      ]);
    }
  
    // Prepare log notes.
    $log_notes = $this->t('Calculated Emissions: @emissions kg CO2e', ['@emissions' => $emissions]);
    if (!empty($log_values)) {
      $log_notes .= "\n" . $this->t('Values used:');
      foreach ($log_values as $category => $value) {
        $log_notes .= "\n" . $this->t('@category: @value', [
          '@category' => $category,
          '@value' => $value,
        ]);
      }
    }
  
    // Save details to log.
    $log_storage = \Drupal::entityTypeManager()->getStorage('log');
    $log = $log_storage->create([
      'type' => 'maintenance',
      'name' => $this->t('Environmental Calculation'),
      'notes' => $log_notes,
    ]);
    $log->save();
  
    // Display the calculated emissions.
    \Drupal::messenger()->addMessage($this->t('Estimated Carbon Emissions: @emissions kg CO2e', ['@emissions' => $emissions]));
  }
  

}