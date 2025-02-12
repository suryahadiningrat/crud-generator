<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD;

trait CreateTraits
{
    public function store(array $data) : object
    {
        return $this->model->create($data);
    }
}