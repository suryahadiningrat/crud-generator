<?php

namespace Suryahadiningrat\CrudGenerator\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Suryahadiningrat\CrudGenerator\Helpers\ReadMigrations;

class CRUDGeneratorCommand extends Command
{
    /**
     * Name and signature command.
     *
     * @var string
     */
    protected $signature = 'crud-generator:generate {--migration= : Path to the migration file}';

    /**
     * Description command.
     *
     * @var string
     */
    protected $description = 'Generate CRUD based on the specified migration file path.';

    /**
     * Running command.
     */
    public function handle()
    {
        
        $migrationPath = $this->option('migration');

        if (!$migrationPath) {
            $this->error('The --migration option is required.');
            return 1;
        }

        $content = ReadMigrations::readFile($migrationPath);

        if ($content === false) {
            $this->error("Failed to read the migration file at: $migrationPath");
            return 1;
        }

        $this->info("Generating CRUD for migration: $migrationPath");
        $this->line($content);

        $this->info('CRUD generation completed successfully!');
        return 0;
    }
}