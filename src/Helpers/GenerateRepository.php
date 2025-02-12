<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class GenerateRepository
{
    
    /**
     * Convert a Laravel migration file to a model string.
     *
     * @param string $modelName name of model
     * @return string|array The generated model as a array, or string if the conversion fails
     */
    public static function generate(string $modelName)
    {
        $repositoryContent = self::generateRepositoryContent($modelName);

        return [
            'name' => $modelName."Repository.php",
            'content' => $repositoryContent
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
    private static function generateRepositoryContent(string $modelName)
    {
        // Default Model content
        $repositoryContent = "<?php

namespace App\Http\Repository;

use Suryahadiningrat\CrudGenerator\Repository\CRUDRepository;
use Suryahadiningrat\CrudGenerator\Repository\Interfaces\CRUDInterfaces;
use App\Models\\$modelName;

class ".$modelName."Repository extends CRUDRepository implements CRUDInterfaces
{

    protected \$model;

    public function __construct()
    {
        \$this->model = new $modelName();
    }

    public function getColumns()
    {
        \$columns = \$this->model->getFillable();
        return \$columns;
    }
}".PHP_EOL;
        
        return $repositoryContent;
    }
}
