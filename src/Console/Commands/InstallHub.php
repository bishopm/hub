<?php

namespace Bishopm\Hub\Console\Commands;

use Illuminate\Console\Command;

class InstallHub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hub:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Hub';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('filament:install', ["--panels" => true]);
        $this->call('make:filament-user');
        $this->call('storage:link');
        echo("All done!");
    }
}
