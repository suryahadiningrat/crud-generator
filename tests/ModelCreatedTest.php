<?php

use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class ModelCreatedTest extends TestCase
{

    private $modelName = "Example.php";

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
    public function model_created()
    {
        // Reading generated model
        $modelPath = config('crud-generator.model_path');
        $model = ReadFile::read($modelPath.'/'.$this->modelName);

        $this->assertIsString($model);

        // Reading sample model
        $testModelPath = config('crud-generator.test_model_path');
        $testModel = ReadFile::read($testModelPath.'/'.$this->modelName);
        $this->assertIsString($testModel);
        
        $this->assertEquals($testModel, $model);
    }
}
