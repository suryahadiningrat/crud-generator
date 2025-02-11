<?php

namespace Suryahadiningrat\CrudGenerator;

use Suryahadiningrat\CrudGenerator\Helpers\Response;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\Helpers\WriteFile;
use Suryahadiningrat\CrudGenerator\Helpers\MigrationToModel;

class CRUDGenerator {

    /**
     * generate crud function
     * 
     * @param string $migrationPath
     */

    public static function generate(string $migrationPath) {
        $modelPath = config('crud-generator.model_path');

        // Reading File and return error if file not defined
        $migrationContent = ReadFile::read($migrationPath);
        if (!$migrationContent) return Response::createError("File $migrationPath not found");

        // Converting $migrationContent to $modelContent
        $modelContent = MigrationToModel::convertMigrationToModel($migrationContent);
        if (isset($modelContent[0])) return Response::createError(@$modelContent[0]);

        WriteFile::write($modelPath, $modelContent['name'], $modelContent['content']);

        return Response::createSuccess("Sucess Generate CRUD from migration $migrationPath");
    }
}