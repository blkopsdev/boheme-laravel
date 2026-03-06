<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Customer;
use App\Transaction;
use Carbon\Carbon;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class SettleNegativeCustomerBalance extends Command
{
    protected $signature = 'customer:settle-negative-balance';
    protected $description = 'Find customers with a negative balance, add necessary credit, and bring balance to zero.';

    public function handle(): void
    {
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, Customer::count());
        $progressBar->start();

        Customer
            ::orderBy('id', 'asc')
            ->chunk(100, function ($customers) use ($progressBar): void {
                foreach ($customers as $customer) {
                    $currentStoreCredit = '0.00';

                    // Calculate current balance
                    Transaction::where('customer_id', $customer->id)
                        ->orderBy('id', 'asc')
                        ->chunk(100, function ($transactions) use (&$currentStoreCredit): void {
                        foreach ($transactions as $transaction) {
                            switch ($transaction->transaction_type) {
                                case 'Add store credit':
                                case 'Add Store Credit For RETURN':
                                    $currentStoreCredit = bcadd($currentStoreCredit, $transaction->store_credit, 2);
                                    break;

                                case 'Cash out for store credit':
                                    $cashOut = bcmul($transaction->cash_out_for_storecredit, '2', 2);
                                    $currentStoreCredit = bcsub($currentStoreCredit, $cashOut, 2);
                                    break;

                                case 'Purchase':
                                    $currentStoreCredit = bcsub($currentStoreCredit, $transaction->store_credit, 2);
                                    break;
                            }
                        }
                    });


                    if (floatval($currentStoreCredit) < -1e-10) {
                        $negativeBalance = abs($currentStoreCredit);

                        DB::beginTransaction();
                        try {
                            // Add a new transaction to correct the balance
                            $transaction = Transaction::create([
                                'customer_id' => $customer->id,
                                'transaction_type' => 'Add store credit',
                                'store_credit' => $negativeBalance,
                                'comments' => 'Auto-adjustment: Added store credit to settle negative balance.',
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);

                            if (!$transaction) {
                                throw new Exception("Transaction creation failed for Customer ID: {$customer->id}");
                            }

                            $customer->update(['available_credit' => '0.00']);

                            // Commit transaction
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();

                            Log::error("Error settling negative balance for Customer ID: {$customer->id}. Error: " . $e->getMessage());
                        }
                    }
                }

                $progressBar->advance(count($customers));
            });

        $progressBar->finish();
    }
}
