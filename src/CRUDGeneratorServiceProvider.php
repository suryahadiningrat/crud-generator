<?php

namespace Suryahadiningrat\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Suryahadiningrat\CrudGenerator\Console\CRUDGeneratorCommand;

class CRUDGeneratorServiceProvider extends ServiceProvider {
    
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/Console/CRUDGeneratorCommand.php' => base_path('app/Console/Commands/CRUDGeneratorCommand.php'),
        ], 'commands');
    }
    
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CRUDGeneratorCommand::class,
            ]);
        }
    }
}