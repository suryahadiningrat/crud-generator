<?php

return [
    'model_namespace' => 'App\Models',
    'model_path' => 'app/Models',
    'request_path' => 'app/Http/Requests',
    'resource_path' => 'app/Http/Resources',
    'repository_path' => 'app/Http/Repository',
    'controller_path' => 'app/Http/Controllers',

    // For Testing Usage (Delete it)
    'test_model_path' => __DIR__.'/../../tests/stubs/Models',
    'test_request_path' => __DIR__.'/../../tests/stubs/Requests',
    'test_resource_path' => __DIR__.'/../../tests/stubs/Resources',
    'test_repository_path' => __DIR__.'/../../tests/stubs/Repository',
    'test_controller_path' => __DIR__.'/../../tests/stubs/Controller',
];