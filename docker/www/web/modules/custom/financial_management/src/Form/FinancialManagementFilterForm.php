<?php

namespace Drupal\financial_management\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form to filter financial records by month and year.
 */
class FinancialManagementFilterForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'financial_management_filter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Dropdown options for months.
    $months = [
      '01' => $this->t('January'),
      '02' => $this->t('February'),
      '03' => $this->t('March'),
      '04' => $this->t('April'),
      '05' => $this->t('May'),
      '06' => $this->t('June'),
      '07' => $this->t('July'),
      '08' => $this->t('August'),
      '09' => $this->t('September'),
      '10' => $this->t('October'),
      '11' => $this->t('November'),
      '12' => $this->t('December'),
    ];

    // Dropdown options for years (e.g., from current year to 10 years ago).
    $current_year = date('Y');
    $years = [];
    for ($year = $current_year; $year >= $current_year - 10; $year--) {
      $years[$year] = $year;
    }

    // Retrieve any existing query values.
    $request = \Drupal::request();
    $selected_month = $request->query->get('month', date('m'));
    $selected_year = $request->query->get('year', $current_year);

    $form['month'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Month'),
      '#options' => $months,
      '#default_value' => $selected_month,
    ];

    $form['year'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Year'),
      '#options' => $years,
      '#default_value' => $selected_year,
    ];

    $form['actions'] = [
      '#type' => 'actions',
    ];

    $form['actions']['filter'] = [
      '#type' => 'submit',
      '#value' => $this->t('Apply Filter'),
    ];

    $form['actions']['reset'] = [
      '#type' => 'submit',
      '#value' => $this->t('Reset'),
      '#submit' => ['::resetFilter'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $month = $form_state->getValue('month');
    $year = $form_state->getValue('year');

    // Redirect to the overview page with month and year as query parameters.
    $form_state->setRedirect('financial_management.overview', [], [
      'query' => ['month' => $month, 'year' => $year],
    ]);
  }

  /**
   * Custom reset filter handler.
   */
  public function resetFilter(array &$form, FormStateInterface $form_state) {
    // Redirect to the overview page without query parameters.
    $form_state->setRedirect('financial_management.overview');
  }
}
