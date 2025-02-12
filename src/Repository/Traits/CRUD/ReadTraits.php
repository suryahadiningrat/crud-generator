<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD;

use App\Models\MasterData\Level;

trait ReadTraits
{
    public function show(int $id)
    {
        $model = $this->model;
        $attributes = $model->getFillable();
        $data = $model->select($attributes)->find($id);
        
        return $data;
    }
}
