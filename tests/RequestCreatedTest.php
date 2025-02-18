<?php

use Orchestra\Testbench\TestCase;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\CRUDGeneratorServiceProvider;

class RequestCreatedTest extends TestCase
{

    private $storeRequestName = "ExampleStoreRequest.php";
    private $updateRequestName = "ExampleUpdateRequest.php";

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
    public function store_request_created()
    {
        // Reading generated request
        $requestPath = config('crud-generator.request_path');
        $request = ReadFile::read($requestPath.'/'.$this->storeRequestName);

        $this->assertIsString($request);

        // Reading sample request
        $testRequestPath = config('crud-generator.test_request_path');
        $testRequest = ReadFile::read($testRequestPath.'/'.$this->storeRequestName);
        $this->assertIsString($testRequest);
        
        $this->assertEquals($testRequest, $request);
    }

    /** @test */
    public function update_request_created()
    {
        // Reading generated request
        $requestPath = config('crud-generator.request_path');
        $request = ReadFile::read($requestPath.'/'.$this->updateRequestName);

        $this->assertIsString($request);

        // Reading sample request
        $testRequestPath = config('crud-generator.test_request_path');
        $testRequest = ReadFile::read($testRequestPath.'/'.$this->updateRequestName);
        $this->assertIsString($testRequest);
        
        $this->assertEquals($testRequest, $request);
    }
}
