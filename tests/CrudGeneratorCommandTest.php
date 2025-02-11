<?php

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class CrudGeneratorCommandTest extends TestCase
{
    private $migrationPath = __DIR__ . '/stubs/example_migration.php';

    protected function getPackageProviders($app)
    {
        return [
            CRUDGeneratorServiceProvider::class,
        ];
    }

    /** @test */
    public function it_can_run_the_crud_generator_command()
    {
        $this->artisan('crud-generator:generate', [
            '--migration' => $this->migrationPath
        ])
        ->expectsOutput("Generating CRUD for migration: ".$this->migrationPath)
        ->assertExitCode(0);
    }
}
