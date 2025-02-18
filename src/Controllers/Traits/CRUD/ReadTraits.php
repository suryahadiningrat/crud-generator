<?php

namespace Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD;

use Suryahadiningrat\CrudGenerator\Helpers\CustomResponse;

trait ReadTraits
{
    public function showRequestHandler($id, $resource)
    {
        $repository = $this->repository;
        $data = $repository->show($id);
        
        if (!$data) return CustomResponse::notFound();
        elseif ($data) return CustomResponse::success((new $resource($data)), "Success Get Data");
    }
}
