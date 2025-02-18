<?php

namespace Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD;

use Illuminate\Http\Request;
use Suryahadiningrat\CrudGenerator\Helpers\CustomResponse;

trait UpdateTraits
{
    public function updateRequestHandler($id, Request $request, $resource)
    {
        $validatedData = $request->validated();
        $repository = $this->repository;
        
        $update = $repository->update($id, $validatedData);

        if (!$update) return CustomResponse::notFound();
        elseif ($update === true) return CustomResponse::update($validatedData);
    }
}
