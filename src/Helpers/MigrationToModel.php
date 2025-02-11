<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class MigrationToModel
{
    
    /**
     * Convert a Laravel migration file to a model string.
     *
     * @param string $migrationContent content of the migration file
     * @return string|null The generated model as a string, or null if the conversion fails
     */
    public static function convertMigrationToModel(string $migrationContent)
    {
        // Extract table name
        preg_match("/Schema::create\('([^']+)'/", $migrationContent, $tableMatches);
        $tableName = $tableMatches[1] ?? false;

        // Extract columns
        preg_match_all("/->(string|integer|float|boolean|date|timestamp)\('([^']+)'\)/", $migrationContent, $columnMatches);
        $columns = $columnMatches[2] ?? [];

        // Generate the model content
        $modelName = self::convertTableNameToModelName($tableName);
        $fillableColumns = implode("', '", $columns);

        // Checking is migrations file contains modelName, tableName, and FillableColumns
        if (!$modelName) return ["Migration not contains a model name"];
        if (!$tableName) return ["Migration not contains a table name"];
        if (!$fillableColumns) return ["Migration not contains fillable columns"];

        preg_match("/->softDeletes\(\)/", $migrationContent, $isUsingSoftDelete);

        return [
            'name' => $modelName.".php",
            'content' => self::generateModelContent($modelName, $tableName, $fillableColumns, $isUsingSoftDelete)
        ];
    }

    /**
     * Convert table name to model name (e.g., users -> User, blog_posts -> BlogPost).
     *
     * @param string $tableName
     * @return string
     */
    private static function convertTableNameToModelName(string $tableName)
    {
        return str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $tableName)));
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
    private static function generateModelContent(string $modelName, string $tableName, string $fillableColumns, $isUsingSoftDelete = false)
    {
        // Default Model content
        $modelContent = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class $modelName extends Model
{
    /**
     * @var string
     */
    protected \$table = '$tableName';

    /**
     * @var array
     */
    protected \$fillable = ['$fillableColumns'];
}".PHP_EOL;

        if ($isUsingSoftDelete) {
            $modelContent = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class $modelName extends Model
{
    use SoftDeletes;
    /**
     * @var string
     */
    protected \$table = '$tableName';

    /**
     * @var array
     */
    protected \$fillable = ['$fillableColumns'];
}".PHP_EOL;
        }
        
        return $modelContent;
    }
}
