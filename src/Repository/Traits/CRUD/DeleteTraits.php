<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD;

trait DeleteTraits
{
    public function destroy(string $id)
    {
        $model = $this->model;
        $data = $model->find($id);

        if ($data) return $data->delete();
        else return 404;
    }
}
