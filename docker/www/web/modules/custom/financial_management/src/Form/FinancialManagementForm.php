<?php

namespace Drupal\financial_management\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form for capturing financial records.
 */
class FinancialManagementForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'financial_management_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['date'] = [
      '#type' => 'date',
      '#title' => $this->t('Date'),
      '#required' => TRUE,
    ];

    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Type'),
      '#options' => [
        'expense' => $this->t('Expense'),
        'revenue' => $this->t('Revenue'),
      ],
      '#required' => TRUE,
    ];

    $form['amount'] = [
      '#type' => 'number',
      '#title' => $this->t('Amount'),
      '#required' => TRUE,
      '#step' => 0.01,
    ];

    $form['notes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Notes'),
      '#required' => FALSE,
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Record'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('amount') <= 0) {
      $form_state->setErrorByName('amount', $this->t('Amount must be greater than 0.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
  
    // Load existing records.
    $records = \Drupal::state()->get('financial_management.records', []);
  
    // Add the new record.
    $records[] = [
      'date' => $values['date'],
      'type' => $values['type'],
      'amount' => $values['amount'],
      'notes' => $values['notes'],
    ];
  
    // Save back to state.
    \Drupal::state()->set('financial_management.records', $records);
  
    \Drupal::messenger()->addMessage($this->t('Financial record saved: @type of @amount on @date', [
      '@type' => ucfirst($values['type']),
      '@amount' => $values['amount'],
      '@date' => $values['date'],
    ]));
  }
  
}