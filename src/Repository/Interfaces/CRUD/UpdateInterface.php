<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD;

interface UpdateInterface {
    public function update(string $id, array $data);
}