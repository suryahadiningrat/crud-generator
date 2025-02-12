<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD;

interface CreateInterface {
    public function store(array $data) : object;
}