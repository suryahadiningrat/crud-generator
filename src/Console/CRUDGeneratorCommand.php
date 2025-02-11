<?php

namespace Suryahadiningrat\CrudGenerator\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Suryahadiningrat\CrudGenerator\CRUDGenerator;
use Suryahadiningrat\CrudGenerator\Helpers\CheckResponse;

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

        if (!$migrationPath) return $this->returnError("The --migration option is required.");

        $response = CRUDGenerator::generate($migrationPath);

        if ($message = CheckResponse::isError($response, $this)) return $this->returnError($message);

        $this->info('CRUD generation completed successfully!');
        return 0;
    }

    /**
     * return error commands
     * 
     * @param string $message
     */
    private function returnError(string $message) {
        $this->error($message);
        return 1;
    }
}