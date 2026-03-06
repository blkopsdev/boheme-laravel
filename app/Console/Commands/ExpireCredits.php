<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Transaction;
use App\Customer;
use Illuminate\Support\Facades\DB;

class ExpireCredits extends Command
{
    protected $signature = 'credits:expire';
    protected $description = 'Expire credits that are past their expiration date';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $executionDate = Carbon::now()->startOfDay();

        // Customer::whereIn('id', [5014])->orderBy('id', 'asc')->chunk(100, function ($customers) use ($executionDate) {
        Customer::orderBy('id', 'asc')->chunk(100, function ($customers) use ($executionDate) {
            foreach ($customers as $customer) {
                $customerId = $customer->id;
                $oneYearAgo = $executionDate->copy()->subYear();

                // Get all valid transactions within the last year
                $transactions = Transaction::where('customer_id', $customerId)
                    ->where('created_at', '>=', $oneYearAgo)
                    ->orderBy('id', 'asc')
                    ->get();

                $storeCreditBalance = 0;
                $storeCreditRecords = [];

                foreach ($transactions as $transaction) {
                    if ($transaction->transaction_type === 'Add store credit') {
                        $storeCreditBalance += $transaction->store_credit;
                        $storeCreditRecords[] = [
                            'id' => $transaction->id,
                            'amount' => $transaction->store_credit,
                            'created_at' => $transaction->created_at,
                            'expired' => false
                        ];
                    } elseif ($transaction->transaction_type === 'Purchase') {
                        $storeCreditBalance -= $transaction->store_credit;
                        foreach ($storeCreditRecords as &$record) {
                            if (!$record['expired'] && $record['amount'] > 0) {
                                if ($transaction->store_credit >= $record['amount']) {
                                    $transaction->store_credit -= $record['amount'];
                                    $record['amount'] = 0;
                                } else {
                                    $record['amount'] -= $transaction->store_credit;
                                    break;
                                }
                            }
                        }
                    } elseif ($transaction->transaction_type === 'Cash out for store credit') {
                        $storeCreditBalance -= ($transaction->cash_out_for_storecredit * 2);
                    }
                }

                // Expire store credits that are older than a year
                $expiredAmount = 0;
                foreach ($storeCreditRecords as &$record) {
                    if (!$record['expired'] && $executionDate->diffInDays($record['created_at']) >= 365 && $record['amount'] > 0) {
                        $storeCreditBalance -= $record['amount'];
                        $record['expired'] = true;
                        $expiredAmount += $record['amount'];

                        // Insert expired transaction in bulk
                        Transaction::insert([
                            'customer_id' => $customerId,
                            'transaction_type' => 'Expired store credit',
                            'purchase_total' => 0,
                            'store_credit' => $record['amount'],
                            'cash_in' => 0,
                            'cash_out_for_storecredit' => 0,
                            'created_at' => $record['created_at']->copy()->addYear()->format('Y-m-d 23:59:59'),
                            'updated_at' => $record['created_at']->copy()->addYear()->format('Y-m-d 23:59:59')
                        ]);
                    }
                }

                // Update the customer's available credit
                Customer::where('id', $customerId)->update(['available_credit' => max(0, $storeCreditBalance)]);

                DB::table('cronjob_data')->insert([
                    'crondata' => json_encode([
                        'customer_id' => $customerId,
                        'expired_amount' => $expiredAmount, // Use total expired amount
                    ]),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        });
    }
}
