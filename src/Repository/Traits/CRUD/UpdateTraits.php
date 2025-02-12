<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Traits\CRUD;

trait UpdateTraits
{
    public function update(string $id, array $data)
    {
        $model = $this->model->find($id);

        if ($model) return $model->update($data);
        else return 404;
    }
}
