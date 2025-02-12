<?php

namespace Suryahadiningrat\CrudGenerator;

use Suryahadiningrat\CrudGenerator\Helpers\Response;
use Suryahadiningrat\CrudGenerator\Helpers\ReadFile;
use Suryahadiningrat\CrudGenerator\Helpers\WriteFile;
use Suryahadiningrat\CrudGenerator\Helpers\MigrationToModel;
use Suryahadiningrat\CrudGenerator\Helpers\GenerateRepository;
use Suryahadiningrat\CrudGenerator\Helpers\MigrationToRepository;

class CRUDGenerator {

    /**
     * generate crud function
     * 
     * @param string $migrationPath
     */

    public static function generate(string $migrationPath) {
        $modelPath = config('crud-generator.model_path');
        $repositoryPath = config('crud-generator.repository_path');

        // Reading File and return error if file not defined
        $migrationContent = ReadFile::read($migrationPath);
        if (!$migrationContent) return Response::createError("File $migrationPath not found");

        // Converting $migrationContent to $modelContent
        $modelContent = MigrationToModel::convertMigrationToModel($migrationContent);
        if (gettype($modelContent) == 'string') return Response::createError($modelContent);
        WriteFile::write($modelPath, $modelContent['fileName'], $modelContent['content']);

        // Generating repository
        $repositoryContent = GenerateRepository::generate($modelContent['name']);
        WriteFile::write($repositoryPath, $repositoryContent['name'], $repositoryContent['content']);

        return Response::createSuccess("Sucess Generate CRUD from migration $migrationPath");
    }
}