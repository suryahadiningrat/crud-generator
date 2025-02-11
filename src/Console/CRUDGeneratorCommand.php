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
        // Check --migration value
        $migrationPath = $this->option('migration');
        if (!$migrationPath) return $this->returnError("The --migration option is required.");

        // Running CRUD generate
        $response = CRUDGenerator::generate($migrationPath);
        if ($message = CheckResponse::isError($response)) return $this->returnError($message);
        
        return $this->returnSuccess(@$response['message']);
    }

    /**
     * return success commands
     * 
     * @param string $message
     */
    private function returnSuccess(string $message) {
        $this->info($message);
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