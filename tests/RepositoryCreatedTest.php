<?php

use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class RepositoryCreatedTest extends TestCase
{

    private $repositoryName = "ExampleRepository.php";

    /**
     * Register the package's service provider.
     */
    protected function getPackageProviders($app)
    {
        return [
            CrudGeneratorServiceProvider::class,
        ];
    }

    /** @test */
    public function repository_created()
    {
        // Reading generated repository
        $repositoryPath = config('crud-generator.repository_path');
        $repository = ReadFile::read($repositoryPath.'/'.$this->repositoryName);

        $this->assertIsString($repository);

        // Reading sample repository
        $testRepositoryPath = config('crud-generator.test_repository_path');
        $testRepository = ReadFile::read($testRepositoryPath.'/'.$this->repositoryName);
        $this->assertIsString($testRepository);
        
        $this->assertEquals($testRepository, $repository);
    }
}
