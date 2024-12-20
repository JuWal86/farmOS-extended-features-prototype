<?php

namespace Drupal\financial_management\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\financial_management\Form\FinancialManagementFilterForm;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Controller for the financial management overview page.
 */
class FinancialManagementController extends ControllerBase {

  /**
   * Displays an overview of all financial records with optional monthly filtering.
   */
  public function overview() {
    $request = \Drupal::request();
    $selected_month = $request->query->get('month', NULL);
    $selected_year = $request->query->get('year', NULL);

    // Retrieve saved records.
    $all_records = \Drupal::state()->get('financial_management.records', []);
    $filtered_records = [];
    $total_revenue = 0;
    $total_expense = 0;

    // Filter records by month and year.
    foreach ($all_records as $record) {
      $record_date = strtotime($record['date']);
      $record_month = date('m', $record_date);
      $record_year = date('Y', $record_date);

      if (
        ($selected_month === NULL || $record_month === $selected_month) &&
        ($selected_year === NULL || $record_year == $selected_year)
      ) {
        $filtered_records[] = $record;

        if ($record['type'] === 'revenue') {
          $total_revenue += $record['amount'];
        } elseif ($record['type'] === 'expense') {
          $total_expense += $record['amount'];
        }
      }
    }

    $total_benefit = $total_revenue - $total_expense;

    // Prepare table header and rows.
    $header = [
      ['data' => $this->t('Date')],
      ['data' => $this->t('Type')],
      ['data' => $this->t('Amount')],
      ['data' => $this->t('Notes')],
    ];

    $rows = [];
    foreach ($filtered_records as $record) {
      $rows[] = [
        'data' => [
          $record['date'],
          ucfirst($record['type']),
          number_format($record['amount'], 2),
          $record['notes'],
        ],
      ];
    }

    return [
      'filter_form' => $this->formBuilder()->getForm(FinancialManagementFilterForm::class),
      'table' => [
        '#type' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#empty' => $this->t('No financial records available for the selected month and year.'),
      ],
      'totals' => [
        '#markup' => $this->t('<strong>Total Revenue:</strong> @revenue<br><strong>Total Expenses:</strong> @expense<br><strong>Total Benefit/Loss:</strong> @benefit', [
          '@revenue' => number_format($total_revenue, 2),
          '@expense' => number_format($total_expense, 2),
          '@benefit' => number_format($total_benefit, 2),
        ]),
        '#prefix' => '<div style="margin-top: 20px; font-size: 1.1em;">',
        '#suffix' => '</div>',
      ],
      'add_link' => [
        '#markup' => Link::fromTextAndUrl(
          $this->t('Add a new financial record'),
          Url::fromRoute('financial_management.add_record')
        )->toString(),
      ],
    ];
  }
}
