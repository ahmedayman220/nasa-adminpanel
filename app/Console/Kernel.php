<?php

namespace App\Console;

use App\Jobs\autoMailJob;
use App\Models\BootcampParticipant;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $participant = new BootcampParticipant();
            // better to add a column in participants table called generated and edit it in job
            // now filter participants with un-generated qr - email put number of needed participants in the limit function argument
            $participant = $participant->where()->limit(5)->get();
            if($participant)
                autoMailJob::dispatch($participant,request()->getHost());
        })->hourly();
//        for testing purposes use ->everyThreeMinutes()
//        you must run both php artisan schedule:work and php artisan queue:work
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
