<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ScheduleDaemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:daemon {--sleep=60}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Roda o schedule do laravel a cada x tempo';

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
        while (true) {
            $this->info('Rodando o schedule');

            $this->call('schedule:run');

            sleep($this->option('sleep'));
        }
    }
}
