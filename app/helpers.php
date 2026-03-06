<?php
/**
 * @return mixed
 * Custom functions made by blkopsdev
 */

require __DIR__.'/laravel_helpers.php';

/**
 * @param string $title
 * @param $model
 * @return string
 */

function unique_slug($title = '', $model = 'Project'){
  $slug = str_slug($title);
  //get unique slug...
  $nSlug = $slug;
  $i = 0;

  $model = str_replace(' ','',"\App\ ".$model);
  while( ($model::whereSlug($nSlug)->count()) > 0){
      $i++;
      $nSlug = $slug.'-'.$i;
  }
  if($i > 0) {
      $newSlug = substr($nSlug, 0, strlen($slug)) . '-' . $i;
  } else
  {
      $newSlug = $slug;
  }
  return $newSlug;
}

function get_store_credit($id, $transaction_id = null) {
    $availableCredit = 0;
    $expirationDate = null;

    $dateMinusYear = strtotime('-1 year');
    // $dateMinus6Months = strtotime('-6 months');

    $transactions = \App\Transaction::whereCustomerId($id)
        ->orderBy('created_at', 'asc')
        ->get();

    foreach ($transactions as $transaction) {
        $transactionDate = strtotime($transaction->created_at);

        if ($transaction->transaction_type == "Add store credit") {
            $isExpired = $transactionDate < ($transactionDate >= strtotime("2021-01-01") ? $dateMinusYear : null);
            // if (!$isExpired) {
                $availableCredit += $transaction->store_credit;
            // }
        } elseif ($transaction->transaction_type == "Purchase") {
            $availableCredit -= $transaction->store_credit;
        } elseif ($transaction->transaction_type == "Cash out for store credit") {
            $availableCredit -= 2 * $transaction->cash_out_for_storecredit;
        } elseif ($transaction->transaction_type == "Expired store credit") {
            $availableCredit -= $transaction->store_credit;
        }

        // Update expiration date
        $expirationDate = $transactionDate >= strtotime("2021-01-01")
            ? strtotime('+12 months', $transactionDate)
            : null;

        if ($transaction_id && $transaction->id == $transaction_id) {
            break;
        }
    }

    return [
        'credit' => max(0, $availableCredit),
        'expires_on' => $expirationDate,
    ];
}
function new_get_store_credit($customerId) {
    // $transactions = \App\NewTransaction::whereCustomerId($customerId)->orderBy('id', 'asc')->get();
    $transactions = \App\Transaction::whereCustomerId($customerId)->orderBy('id', 'asc')->get();
    $credit_balance = 0;
    foreach ($transactions as $transaction) {
        switch ($transaction->transaction_type) {
            case 'Add store credit':
                $credit_balance += number_format($transaction->store_credit, 2);
                break;
            case 'Add Store Credit For RETURN':
                $credit_balance += number_format($transaction->store_credit, 2);
                break;
            case 'Purchase':
                $credit_balance -= number_format($transaction->store_credit, 2);
                break;

            case 'Cash out for store credit':
                $credit_balance -= number_format($transaction->cash_out_for_storecredit * 2, 2);
                break;
            case 'Expired':
                $credit_balance -= number_format($transaction->store_credit, 2);
                break;
            default:
                $credit_balance += number_format($transaction->store_credit, 2);
                break;
        }
    }
    return $credit_balance;
}
function get_option($option_name) {
    $option = \App\Option::whereOptionName($option_name)->first();
    return $option->option_value;
}