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

function get_store_credit($id, $transaction_id) {
    $results = 0;
    $avail_credit = 0;
    $avail_credit_unexpired_tally = 0;
    $avail_credit_expired_tally = 0;
    $purchases_over_one_year = 0;
    $expirationDate = "";

    $transactions = \App\Transaction::whereCustomerId($id)->orderBy('id', 'asc')->get();
    foreach ($transactions as $transaction) {
        # code...
        $dateMinusYear = strtotime(date("Y-m-d").' -1 year');
        $dateMinus6Months = strtotime(date("2015-10-01").' -6 months'); // New 6 month expiration
        $transactionDate = strtotime($transaction->created_at);
    
        $expiredFlag = 0;
    
        if ($transaction->transaction_type == "Add store credit" && $transactionDate <= strtotime(date('2015-05-05')) && $transactionDate >= $dateMinusYear){
            $avail_credit_unexpired_tally = $avail_credit_unexpired_tally + $transaction->store_credit;
            $expiredFlag = 0;
        } else if ($transaction->transaction_type == "Add store credit" && $transactionDate > strtotime(date('2015-05-05')) && $transactionDate >= $dateMinus6Months){
            $avail_credit_unexpired_tally = $avail_credit_unexpired_tally + $transaction->store_credit;
            $expiredFlag = 0;
        } else if ($transaction->transaction_type == "Add store credit"){ 
            $expiredFlag = 1;
        } 
    
        if ($transaction->transaction_type == "Purchase" && $transactionDate >= $dateMinusYear){
            $purchases_over_one_year = $purchases_over_one_year + $transaction->store_credit;
        }
            
        if ($transaction->transaction_type == "Cash out for store credit"){
            $avail_credit_unexpired_tally = $avail_credit_unexpired_tally - $transaction->cash_out_for_storecredit * 2;
        }
            
        $avail_credit_unexpired  = $avail_credit_unexpired_tally - $purchases_over_one_year; // doing nothing it seems.. not used elsewhere...
            
        // NEXT we calc the EXPIRED store credit tally so we can subtract it in the ledger in each subsequent transaction:
            
        if ($transaction->transaction_type == "Add store credit" && $transactionDate < $dateMinusYear){
            $avail_credit_expired_tally = $transaction->store_credit;
            $avail_credit = $avail_credit - $avail_credit_expired_tally;
        }
    
        if ($expiredFlag == 1 && $transactionDate <= strtotime(date("2015-05-05")) && $transactionDate < $dateMinusYear) {
            $expirationDate = strtotime('12 months', $transactionDate); 
        } else if ($expiredFlag == 1 && $transactionDate > strtotime(date("2015-05-05")) && $transactionDate <= $dateMinus6Months) {
            $expirationDate = strtotime('6 months', $transactionDate); 
        } else if ($expiredFlag == 0 && $transactionDate <= strtotime(date("2015-05-05")) && $transactionDate > $dateMinusYear) {
            $expirationDate = strtotime('12 months', $transactionDate); 
        } else if ($expiredFlag == 0 && $transactionDate > strtotime(date("2015-05-05")) && $transactionDate > $dateMinus6Months) {
            $expirationDate = strtotime('6 months', $transactionDate); 
        } 
    
        $expiredFlag = 0;
    
        if ($transaction->transaction_type == "Add store credit") {
            $avail_credit = $avail_credit + $transaction->store_credit;
        }
            
        if ( $transaction->transaction_type == "Purchase"){
            $avail_credit = $avail_credit - $transaction->store_credit;
        }
            
        if ( $transaction->transaction_type == "Cash out for store credit"){
            $avail_credit = $avail_credit - (2 * $transaction->cash_out_for_storecredit);
        }
    
        $cash = $transaction->cash_in + $transaction->cash_out_for_trade + $transaction->cash_out_for_storecredit;
        $cash = number_format($cash, 2, '.', '');
    
        if (( $transaction->transaction_type == "Cash out for store credit") || ( $transaction->transaction_type == "Cash out for trade")){
            $cash = "-$" . $cash;
        }else{
            $cash = "$" . $cash;
        } 
        
        if ($avail_credit <= 0 ) {
            $avail_credit = 0.00 * 1;  // this is because 0 wasn't acting like a number so i tried this multiply trick...?
        }
    
        if ($transaction->id == $transaction_id) {
            $results = [
                'credit' => $avail_credit,
                'expires_on' => $expirationDate
            ];
            break;
        }
    }

    return $results;
}