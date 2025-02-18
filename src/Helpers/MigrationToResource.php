<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class MigrationToResource
{
    /**
     * Convert a Laravel migration file to a resource string.
     *
     * @param string $migrationContent Content of the migration file
     * @return array The generated resource as an array with filename and content
     */
    public static function convertMigrationToResource(string $migrationContent)
    {
        // Extract table name
        preg_match("/Schema::create\('([^']+)'/", $migrationContent, $tableMatches);
        $tableName = $tableMatches[1] ?? false;

        // Extract columns
        preg_match_all("/->(id|bigIncrements|string|integer|float|boolean|date|timestamp|json)\('([^']+)'\)/", $migrationContent, $columnMatches);
        $columns = $columnMatches[2] ?? [];

        if (!$tableName || empty($columns)) {
            return null;
        }

        $modelName = self::convertTableNameToModelName($tableName);
        $resourceContent = self::generateResourceContent($modelName, $columns);

        return [
            'fileName' => "{$modelName}Resource.php",
            'content' => $resourceContent
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
     * Generate resource file content.
     *
     * @param string $modelName
     * @param array $columns
     * @return string
     */
    private static function generateResourceContent(string $modelName, array $columns)
    {
        // Generate the resource fields dynamically
        $resourceFields = [];
        foreach ($columns as $column) {
            $resourceFields[] = "'$column' => \$this->$column,";
        }

        $resourceFieldsString = implode("\n            ", $resourceFields);

        return <<<PHP
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class {$modelName}Resource extends JsonResource
{
    public function toArray(\$request)
    {
        return [
            $resourceFieldsString
        ];
    }
}
PHP;
    }
}
