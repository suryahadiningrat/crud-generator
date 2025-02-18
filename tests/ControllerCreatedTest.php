<?php

use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class ControllerCreatedTest extends TestCase
{

    private $controllerName = "ExampleController.php";

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
    public function controller_created()
    {
        // Reading generated controller
        $controllerPath = config('crud-generator.controller_path');
        $controller = ReadFile::read($controllerPath.'/'.$this->controllerName);

        $this->assertIsString($controller);

        // Reading sample controller
        $testControllerPath = config('crud-generator.test_controller_path');
        $testController = ReadFile::read($testControllerPath.'/'.$this->controllerName);
        $this->assertIsString($testController);
        
        $this->assertEquals($testController, $controller);
    }
}
