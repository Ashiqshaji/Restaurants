<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RunQueueWorker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */


    protected $signature = 'app:run-queue-worker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the queue worker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        exec('php artisan queue:work --sleep=3 --tries=3');
    }
}
