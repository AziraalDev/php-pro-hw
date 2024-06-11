<?php

namespace App\Commands;

use CliAssistant;
use Exception;

class MigrationCreate implements Command
{
    const string MIGRATIONS_DIR = BASE_DIR . '/migrations';

    public function __construct(public CliAssistant $cliAssistant, public array $args = [])
    {
    }

    public function run(): void
    {
        $this->createDir();
        $this->createMigration();
    }

    protected function createDir(): void
    {
        if (!file_exists(self::MIGRATIONS_DIR)) {
            mkdir(self::MIGRATIONS_DIR);
        }
    }

    protected function createMigration()
    {
        $name = time() . '_' . $this->args[0];
        $fullPath = self::MIGRATIONS_DIR . "/$name.sql";

        try {
            file_put_contents($fullPath, '', FILE_APPEND);
            $this->cliAssistant->info('File has been created',
                                             ['file' => $fullPath]);
        } catch (Exception $exception) {
            $this->cliAssistant->error($exception->getMessage());
        }

    }

}