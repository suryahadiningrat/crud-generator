<?php

namespace Suryahadiningrat\CrudGenerator\Repository;

use Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD\ReadTraits;
use Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD\CreateTraits;
use Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD\UpdateTraits;
use Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD\DeleteTraits;

class CRUDRepository
{
    use CreateTraits, ReadTraits, UpdateTraits, DeleteTraits;

    public function getAll()
    {
        $model = $this->model;
        $attributes = $model->getFillable();
        
        return $model->select($attributes)->get();
    }

    public function getFillable()
    {
        return $this->model->getFillable();
    }
}
