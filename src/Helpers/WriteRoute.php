<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

use Symfony\Component\Filesystem\Filesystem;

class WriteRoute
{
    /**
     * Write API routes for a given model into routes/web.php if they don't exist.
     *
     * @param string $modelName
     * @param string $routesFilePath Path to routes/web.php
     * @return void
     */
    public static function writeRoutes(string $modelName, string $routesFilePath)
    {
        $filesystem = new Filesystem();
        $modelNameLower = strtolower($modelName);

        // Define the new route block
        $routeBlock = <<<PHP

// Routes for {$modelName}
\$router->group(['prefix' => '{$modelNameLower}'], function () use (\$router) {
    \$router->get('', '{$modelName}Controller@index');
    \$router->post('', '{$modelName}Controller@store');
    \$router->get('{id}', '{$modelName}Controller@show');
    \$router->put('{id}', '{$modelName}Controller@update');
    \$router->delete('{id}', '{$modelName}Controller@destroy');
});
PHP;

        // Ensure routes file exists, create if necessary
        if (!$filesystem->exists($routesFilePath)) {
            return "Target route file not exist";
        }

        // Read existing file content
        $existingContent = file_get_contents($routesFilePath);

        // Check if the route already exists to avoid duplication
        $routePattern = "/\\\$router->group\\(\\['prefix' => '{$modelNameLower}'\\], function \\(\\) use \\(\\\$router\\) \\{/";
        if (preg_match($routePattern, $existingContent)) {
            return "Routes for {$modelName} already exist in {$routesFilePath}.\n";
        }

        // Append the new route block
        $newContent = $existingContent . "\n" . $routeBlock . "\n";

        // Write back to the routes file
        $filesystem->dumpFile($routesFilePath, $newContent);

        return true;
    }
}
