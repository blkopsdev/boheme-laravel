<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Customer;
use App\Transaction;
use Carbon\Carbon;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NegativeBalanceExport;

class CustomersBalance extends Command
{
    protected $signature = 'customersbalance:run';
    protected $description = 'Process store credit transactions for all customers and export negative balances.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $totalCustomers = Customer::count();
        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $totalCustomers);
        $progressBar->start();

        $negativeBalances = [];

        Customer::orderBy('id', 'asc')->chunk(100, function ($customers) use ($progressBar, &$negativeBalances) {
            foreach ($customers as $customer) {
                $customerId = $customer->id;
                $currentStoreCredit = '0.00';

                $transactions = Transaction::where('customer_id', $customerId)->orderBy('id', 'asc')->get();
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
                $currentStoreCredit = floatval($currentStoreCredit);
                // Store customer ID and balance if negative
                if ($currentStoreCredit < -1e-10) {
                    $negativeBalances[] = [
                        'Customer ID' => $customerId,
                        'Negative Balance' => $currentStoreCredit
                    ];
                }
            }
            $progressBar->advance(count($customers));
        });

        $progressBar->finish();

        // Export to Excel if there are negative balances
        if (!empty($negativeBalances)) {
            Excel::store(new NegativeBalanceExport($negativeBalances), 'negative_balances.xlsx');
            $this->info("\nNegative balances exported to storage/app/negative_balances.xlsx");
        } else {
            $this->info("\nNo customers with negative balances.");
        }
    }
}
