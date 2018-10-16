<?php

namespace App\Ship\Kernels;

use App\Containers\Order\Jobs\ComplateJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as LaravelConsoleKernel;

/**
 * Class ConsoleKernel
 *
 * A.K.A (app/Console/Kernel.php)
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class ConsoleKernel extends LaravelConsoleKernel
{

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // NOTE: your Containers command will all be auto registered for you.
        // Same for the Ship commands who live in the `app/Ship/Commands/` directory.
        // If you have commands living somewhere else then consider registering them manually here.
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ComplateJob())->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // NOTE: No need to load your Commands manually from here.
        // As they are automatically registered by the Apiato Loader.

        // $this->load(__DIR__.'/Commands');
        // require base_path('routes/console.php');
    }

}
