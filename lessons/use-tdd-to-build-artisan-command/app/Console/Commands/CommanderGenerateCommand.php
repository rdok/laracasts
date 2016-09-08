<?php

namespace App\Console\Commands;

use Acme\Console\CommandInputParser;
use Illuminate\Console\Command;
use Mustache_Engine;

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
     * @var CommandInputParser
     */
    private $commandInputParser;

    /**
     * Create a new command instance.
     * @param CommandInputParser $commandInputParser
     */
    public function __construct(CommandInputParser $commandInputParser)
    {
        parent::__construct();

        $this->commandInputParser = $commandInputParser;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $commandInputParser = $this->commandInputParser->parse(
            $this->getClassPath(),
            $this->option('properties')
        );

        $template = file_get_contents(app_path('Console/Commands/templates/command.template'));

        $mustache = new Mustache_Engine();

        $template = $mustache->render($template, [
            'className' => $commandInputParser->className,
            'namespace' => $commandInputParser->namespace,
        ]);

        file_put_contents("{$base}/{$path}.php", $template);

        $this->info('All done!');
    }

    private function getClassPath()
    {
        return $this->option('base') . '/' . $this->argument('path');
    }
}
