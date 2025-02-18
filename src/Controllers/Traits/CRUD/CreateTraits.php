<?php

namespace Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD;

use Illuminate\Http\Request;
use Suryahadiningrat\CrudGenerator\Helpers\CustomResponse;

trait CreateTraits
{
    public function storeRequestHandler(Request $request, $resource)
    {
        $validatedData = $request->validated();
        $repository = $this->repository;
        
        $data = $repository->store($validatedData);

        return CustomResponse::create((new $resource($data)));
    }
}
