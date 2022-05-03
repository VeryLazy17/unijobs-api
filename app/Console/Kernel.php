<?php

namespace App\Console;

use File;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
//        $schedule->command('backup:clean')->everyMinute();
//        $schedule->command('backup:run --only-db')->everyMinute();
//        $this->test();
    }

    public function test()
    {
        $url = "https://api.telegram.org/bot";
        $token = "2065553356:AAGn1D9LfVSlusSsrThSZ8g2aPI3ieXlAVg";
        $method = "/sendDocument";
        $chatId = "1443440767";

        $files = 'uploads/Laravel/2021-10-30-10-55-00.zip';

        Http::attach('document', file_get_contents('uploads/Laravel/2021-10-30-10-55-00.zip'), $files->getClientOriginalName())
            ->post($url . $token . $method, [
                'chat_id' => $chatId,
            ]);

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
