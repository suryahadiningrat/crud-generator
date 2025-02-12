<?php

namespace Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD;

interface DeleteInterface {
    public function destroy(string $id);
}