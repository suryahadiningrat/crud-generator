<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ExampleStoreRequest;
use App\Http\Requests\ExampleUpdateRequest;

use App\Http\Resources\ExampleResource;
use Suryahadiningrat\CrudGenerator\Controllers\CRUDController;

use App\Http\Repository\ExampleRepository;

class ExampleController extends CRUDController
{
    public function __construct()
    {
        $this->repository = new ExampleRepository();
        $this->ExampleResource = ExampleResource::class;
    }

    public function index() 
    {
        return $this->indexRequestHandler($this->ExampleResource);
    }

    public function store(ExampleStoreRequest $request) 
    {
        return $this->storeRequestHandler($request, $this->ExampleResource);
    }

    public function update($id, ExampleUpdateRequest $request)
    {
        return $this->updateRequestHandler($id, $request, $this->ExampleResource);
    }

    public function show($id) 
    {
        return $this->showRequestHandler($id, $this->ExampleResource);
    }
}
