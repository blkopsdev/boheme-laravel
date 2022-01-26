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

function store_credit($id) {
    $storeCredit = 0;

    $expiration_period = 12;
    $expiration_date = \Carbon\Carbon::now()->subMonths($expiration_period);
    $transactions = \App\Transaction::whereCustomerId($id)->get();
    // foreach ($transactions as $transaction) {
    //     if($transaction->transaction_type == 'Add store credit') {
    //         $storeCredit = $storeCredit + $transaction->store_credit;
    //     } else {
    //         $storeCredit = $storeCredit - $transaction->store_credit;
    //     }
    // }
    $ischecked = [];
    $sum = 0;
    $sums = [];
    $index = -1;
    $lastindex = 0;
    // if(count($transactions) > 1) {
        for($i = 0; $i < count($transactions); $i ++ ){
            for($j = 0; $j < $index; $j ++){
                $date1 = strtotime(' + 1 year',$sums[$j]['expire']);
                $date2 = strtotime($transactions[$i]->created_at);
                if($date1 < $date2) {
                    $sums[$j]['value'] = 0;
                };
            }
            if($transactions[$i]->transaction_type == 'Add store credit') {
                $index ++;
                $sums[$index] = [];
                $sums[$index]['value'] = $transactions[$i]->store_credit;
                $sums[$index]['expire'] = strtotime($transactions[$i]->created_at);
            } else {
                // if($sums[$lastindex]['value'] - $transactions[$i]->store_credit - $transactions[$i]->cash_out_for_storecredit >= 0){
                // } else{
                //     $sums[$lastindex + 1]['value'] += $sums[$lastindex]['value'];
                //     $lastindex ++;
                // }
                // $sums[$lastindex]['value'] -= $transactions[$i]->store_credit;
                // $sums[$lastindex]['value'] -= $transactions[$i]->cash_out_for_storecredit;
                $tempminus = $transactions[$i]->store_credit + $transactions[$i]->cash_out_for_storecredit;
                while(true) {
                    if($sums[$lastindex]['value'] - $tempminus >= 0){
                        $sums[$lastindex]['value'] -= $tempminus;
                        break;
                    } else{
                        $tempminus -= $sums[$lastindex]['value'];
                        $sums[$lastindex]['value'] = 0;
                        $lastindex ++;
                    }
                }

            } 
        }
        

        for($i = 0; $i <= $index; $i ++) {
            $date1 = strtotime(' + 1 year',$sums[$i]['expire']);
            $date2 = strtotime(now());
            if($date1 < $date2) continue;
            $sum += $sums[$i]['value'];
        }
    // } else {
    //     $date1 = strtotime(' + 1 year',strtotime($transactions[0]->created_at));
    //     $date2 = strtotime(now());
    //     if($date1 < $date2) {
    //         $sum = 0;
    //     } else {
    //         $sum = $transactions[0]->store_credit;
    //     }
    // }
    $storeCredit = $sum;

    return $storeCredit;
}