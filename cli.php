<?php

const BASE_DIR = __DIR__;
require BASE_DIR . '/vendor/autoload.php';

use App\Commands\Command;
use App\Commands\MigrationCreate;
use App\Commands\MigrationRun;
use splitbrain\phpcli\CLI;
use splitbrain\phpcli\Options;

class CliAssistant extends CLI
{
    // register options and arguments
    protected function setup(Options $options): void
    {
        $options->registerCommand('migration:create',
            'Create migration file');
        $options->registerArgument('name',
            'Migration file name',
            true,
            'migration:create');
        $options->registerCommand('migration:run',
            'Run all migrations');
    }

    protected function main(Options $options): void
    {
        $cmd = match ($options->getCmd()) {
            "migration:create" => new MigrationCreate($this, $options->getArgs()),
            "migration:run" => new MigrationRun($this, $options->getArgs()),
            default => null
        };

        if ($cmd instanceof Command) {
            call_user_func([$cmd, 'run']);
        } else {
            $this->warning('No command specified');
            $options->help();
        }
    }
}

$cli = new CliAssistant();
$cli->run();