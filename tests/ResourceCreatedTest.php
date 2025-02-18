<?php

use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class ResourceCreatedTest extends TestCase
{

    private $resourceName = "ExampleResource.php";
    private $resourceNameSoftDelete = "ExampleSoftDeleteResource.php";

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
    public function resource_created()
    {
        // Reading generated resource
        $resourcePath = config('crud-generator.resource_path');
        $resource = ReadFile::read($resourcePath.'/'.$this->resourceName);

        $this->assertIsString($resource);

        // Reading sample resource
        $testResourcePath = config('crud-generator.test_resource_path');
        $testResource = ReadFile::read($testResourcePath.'/'.$this->resourceName);
        $this->assertIsString($testResource);
        
        $this->assertEquals($testResource, $resource);
    }

    /** @test */
    public function soft_delete_resource_created()
    {
        // Reading generated resource
        $resourcePath = config('crud-generator.resource_path');
        $resource = ReadFile::read($resourcePath.'/'.$this->resourceNameSoftDelete);

        $this->assertIsString($resource);

        // Reading sample resource
        $testResourcePath = config('crud-generator.test_resource_path');
        $testResource = ReadFile::read($testResourcePath.'/'.$this->resourceNameSoftDelete);
        $this->assertIsString($testResource);
        
        $this->assertEquals($testResource, $resource);
    }
}
