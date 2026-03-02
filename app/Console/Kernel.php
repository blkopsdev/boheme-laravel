<?php

namespace App\Console;

use App\Console\Commands\CheckStoreCredit;
use App\Console\Commands\DatabaseBackUp;
use App\Console\Commands\ExpireCredits;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        CheckStoreCredit::class,
        DatabaseBackUp::class,
        ExpireCredits::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('check-store-credit:run')->hourly();
        $schedule->command('database:backup')->daily();
        $schedule->command('credits:expire')->dailyAt('23:50');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
