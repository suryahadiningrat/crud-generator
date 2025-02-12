<?php

namespace App\Http\Repository;

use Suryahadiningrat\CrudGenerator\Repository\CRUDRepository;
use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUDInterfaces;
use App\Models\Example;

class ExampleRepository extends CRUDRepository implements CRUDInterfaces
{

    protected $model;

    public function __construct()
    {
        $this->model = new Example();
    }

    public function getColumns()
    {
        $columns = $this->model->getFillable();
        return $columns;
    }
}
