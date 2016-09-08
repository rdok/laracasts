<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CommanderGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commander:generate 
                            {path : Path to the command class to generate.}
                            {--properties= : List of properties to build.}
                            {--base= : The base directory to begin from.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate command and handler classes.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('All done!');

        $path = $this->argument('path');
        $base = $this->option('base');
        $template = app_path('app/Console/Commands/templates/command.template');

        file_put_contents("{$base}/{$path}.php", '');
    }
}
