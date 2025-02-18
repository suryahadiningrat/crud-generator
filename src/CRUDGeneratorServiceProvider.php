<?php

namespace Suryahadiningrat\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Suryahadiningrat\CrudGenerator\Console\CRUDGeneratorCommand;

class CRUDGeneratorServiceProvider extends ServiceProvider {
    
    public function boot()
    {
        if (!function_exists('config_path')) {
            function config_path($path = '')
            {
                return base_path('config') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
            }
        }

        $this->publishes([
            __DIR__ . '/Console/CRUDGeneratorCommand.php' => base_path('app/Console/Commands/CRUDGeneratorCommand.php'),
        ], 'commands');

        $this->publishes([
            __DIR__ . '/Config/crud-generator.php' => config_path('crud-generator.php'),
        ], 'crud-generator-config');
    }
    
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CRUDGeneratorCommand::class,
            ]);
        }

        $this->mergeConfigFrom(
            __DIR__ . '/Config/crud-generator.php',
            'crud-generator'
        );
    }
}