<?php

use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class CrudGeneratorCommandTest extends TestCase
{
    private $migrationPath = __DIR__ . '/stubs/example_migration.php';
    private $wrongMigrationPath = __DIR__ . '/stubs/example_migration.sphp';

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
        ->assertExitCode(0);
    }

    /** @test */
    public function return_error_when_migrations_params_not_exist()
    {
        $this->artisan('crud-generator:generate')
        ->assertExitCode(1);
    }

    /** @test */
    public function return_error_when_migrations_params_file_not_exist()
    {
        $this->artisan('crud-generator:generate', [
            '--migration' => $this->wrongMigrationPath
        ])
        ->assertExitCode(1);
    }
}
