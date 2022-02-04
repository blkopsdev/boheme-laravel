<?php

namespace App\Console\Commands;

use App\Customer;
use Illuminate\Console\Command;

class CheckStoreCredit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-store-credit:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Available Store Credit Of Customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customers = Customer::get();
        foreach ($customers as $customer) {
            $credits = get_store_credit($customer->id);
            if($credits['credit'] != 0) {
                $customer->available_credit = $credits['credit'];
                $customer->update();
            }
            // echo $customer->id . "\n";
        }
        return 0;
    }
}
