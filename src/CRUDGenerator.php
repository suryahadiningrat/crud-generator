<?php

namespace Suryahadiningrat\CrudGenerator;

use Suryahadiningrat\CrudGenerator\Helpers\Response;
use Suryahadiningrat\CrudGenerator\Helpers\ReadMigrations;

class CRUDGenerator {

    /**
     * generate crud function
     * 
     * @param string $migrationPath
     */

    public static function generate(string $migrationPath) {
        // Reading File and return error if file not defined
        $content = ReadMigrations::readFile($migrationPath);
        if (!$content) return Response::createError("File $migrationPath not found");

        
    }
}