<?php

namespace Suryahadiningrat\CrudGenerator\Controllers;

use App\Facades\CustomResponse;
use Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD\ReadTraits;
use Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD\CreateTraits;
use Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD\UpdateTraits;
use Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD\DeleteTraits;

use Suryahadiningrat\CrudGenerator\Controllers\Controller as BaseController;

class CRUDController extends BaseController
{
    use CreateTraits, ReadTraits, UpdateTraits, DeleteTraits;

    public function indexRequestHandler($resource)
    {
        $repository = $this->repository;
        $data = $repository->getAll();

        return CustomResponse::success($resource::collection($data), "Success Get All Data");
    }
}
