<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class GenerateController
{
    
    /**
     * Convert a Laravel migration file to a model string.
     *
     * @param string $modelName name of model
     * @return string|array The generated model as a array, or string if the conversion fails
     */
    public static function generate(string $modelName)
    {
        $controllerContent = self::generateControllerContent($modelName);

        return [
            'name' => $modelName."Controller.php",
            'content' => $controllerContent
        ];
    }

    /**
     * Generating model content (Normal Model, and Model using SoftDelete)
     * 
     * @param string $modelName
     * @param string $tableName
     * 
     * @param string $fillableColumns
     * @param bool $isUsingSoftDelete (default false)
     */
    private static function generateControllerContent(string $modelName)
    {
        // Default Model content
        $controllerContent = '<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\\'.$modelName.'StoreRequest;
use App\Http\Requests\\'.$modelName.'UpdateRequest;

use App\Http\Resources\\'.$modelName.'Resource;
use Suryahadiningrat\CrudGenerator\Controllers\CRUDController;

use App\Http\Repository\\'.$modelName.'Repository;

class '.$modelName.'Controller extends CRUDController
{
    public function __construct()
    {
        $this->repository = new '.$modelName.'Repository();
        $this->'.$modelName.'Resource = '.$modelName.'Resource::class;
    }

    public function index() 
    {
        return $this->indexRequestHandler($this->'.$modelName.'Resource);
    }

    public function store('.$modelName.'StoreRequest $request) 
    {
        return $this->storeRequestHandler($request, $this->'.$modelName.'Resource);
    }

    public function update($id, '.$modelName.'UpdateRequest $request)
    {
        return $this->updateRequestHandler($id, $request, $this->'.$modelName.'Resource);
    }

    public function show($id) 
    {
        return $this->showRequestHandler($id, $this->'.$modelName.'Resource);
    }
}'.PHP_EOL;
        
        return $controllerContent;
    }
}
