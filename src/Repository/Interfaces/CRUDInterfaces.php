<?php
    namespace Suryahadiningrat\CrudGenerator\Repository\Interfaces;

    use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD\ReadInterface;
    use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD\CreateInterface;
    use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD\UpdateInterface;
    use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUD\DeleteInterface;

    interface CRUDInterfaces extends CreateInterface, ReadInterface, UpdateInterface, DeleteInterface {
    }
?>