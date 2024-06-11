<?php

namespace App\Commands;

use CliAssistant;
use PDO;
use PDOException;
use splitbrain\phpcli\Exception;

class MigrationRun implements Command
{
    const string MIGRATIONS_DIR = BASE_DIR . '/migrations';

    public function __construct(public CliAssistant $cliAssistant,
                                public array        $args = []){}

    public function run(): void
    {
        try {
            db()->beginTransaction();
            $this->cliAssistant->info('Starting database migration...');

            $this->createMigrationTable();
            $this->runMigrations();

            if (db()->inTransaction()) {
                db()->commit();
            }
            $this->cliAssistant->info('Database migration completed successfully.');
        } catch (PDOException $exception) {
            if (db()->inTransaction()) {
                db()->rollBack();
            }
            $this->cliAssistant->fatal('Database migration failed: ' . $exception->getMessage(),
                $exception->getTrace());
        }
    }

    private function createMigrationTable(): void
    {
        $this->cliAssistant->info('Creating migrations table...');

        $query = db()->prepare("
            CREATE TABLE IF NOT EXISTS migrations (
                id INT(8) UNSIGNED PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL UNIQUE
            )"
        );

        if (!$query->execute()) {
            throw new Exception('Failed to create the migrations table.');
        }
        $this->cliAssistant->success('Migrations table created successfully.');
    }

    public function runMigrations(): void
    {
        $this->cliAssistant->info('Fetching migrations table...');

        $migrations = scandir(self::MIGRATIONS_DIR);
        $migrations = array_values(array_diff($migrations, ['.', '..']));

        $this->cliAssistant->notice(json_encode($migrations));
        $handledMigrations = $this->getHandledMigration();
        $this->cliAssistant->notice(json_encode($handledMigrations));

        if (!empty($migrations)) { // IF there are migrations
            foreach ($migrations as $migration) { // Looping migrations
                $this->cliAssistant->notice('Migration: ' . $migration);

                if (in_array($migration, $handledMigrations)) {
                    $this->cliAssistant->notice("--skipping `$migration`");
                    continue;
                }
                $sql = file_get_contents(static::MIGRATIONS_DIR . '/' . $migration);
                $query = db()->prepare($sql);
                if ($query->execute()) {
                    $this->createMigrationRecord($migration);
                    $this->cliAssistant->success("...`$migration` created successfully.`");
                }
            }
        }
    }
    protected function createMigrationRecord (string $migration): void
    {
        $query = db()->prepare("INSERT INTO migrations (name) VALUES (:name)");
        $query->bindParam(':name', $migration);
        $query->execute();
    }
    private function getHandledMigration(): array
    {
        $query = db()->prepare("SELECT name FROM migrations");
        $query->execute();

        return array_map(fn($item) => $item['name'], $query->fetchAll()); // Required for skipping duplicates
    }
}