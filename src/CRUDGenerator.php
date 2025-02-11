<?php

namespace Suryahadiningrat\CrudGenerator;

use Suryahadiningrat\CrudGenerator\Helpers\Response;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;

class CRUDGenerator {

    /**
     * generate crud function
     * 
     * @param string $migrationPath
     */

    public static function generate(string $migrationPath) {
        // Reading File and return error if file not defined
        $content = ReadFile::read($migrationPath);
        if (!$content) return Response::createError("File $migrationPath not found");

        return Response::createSuccess("Sucess Generate CRUD from migration $migrationPath");
    }
}