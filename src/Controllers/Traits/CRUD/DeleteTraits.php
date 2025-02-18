<?php

namespace Suryahadiningrat\CrudGenerator\Controllers\Traits\CRUD;

use Suryahadiningrat\CrudGenerator\Helpers\CustomResponse;

trait DeleteTraits
{
    public function destroy($id)
    {   
        $delete = $this->repository->destroy($id);

        if ($delete === 404) return CustomResponse::notFound();
        elseif ($delete === true) return CustomResponse::delete($delete);
    }
}
