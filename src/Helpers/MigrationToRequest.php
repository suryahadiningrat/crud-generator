<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class MigrationToRequest
{
    /**
     * Convert a Laravel migration file to validation rules.
     *
     * @param string $migrationContent content of the migration file
     * @return array
     */
    public static function convertMigrationToRequest(string $migrationContent)
    {
        // Extract table name
        preg_match("/Schema::create\('([^']+)'/", $migrationContent, $tableMatches);
        $tableName = $tableMatches[1] ?? false;

        // Extract columns and define rules
        preg_match_all("/->(id|bigIncrements|string|integer|float|boolean|date|timestamp)\('([^']+)'\)/", $migrationContent, $columnMatches);
        $columns = $columnMatches[2] ?? [];

        if (!$tableName || empty($columns)) {
            return null;
        }
        
        $modelName = self::convertTableNameToModelName($tableName);
        $storeValidationRules = self::generateValidationRules($migrationContent, $tableName, true);
        $updateValidationRules = self::generateValidationRules($migrationContent, $tableName, false);
        return [
            [
                'fileName' => "{$modelName}StoreRequest.php",
                'content' => self::generateRequestContent($modelName, $storeValidationRules, true)
            ],
            [
                'fileName' => "{$modelName}UpdateRequest.php",
                'content' => self::generateRequestContent($modelName, $updateValidationRules, false)
            ]
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
     * Generate validation rules based on migration columns.
     *
     * @param string $migrationContent
     * @param string $tableName
     * @param bool $isStoreRequest
     * @return array
     */
    private static function generateValidationRules(string $migrationContent, string $tableName, bool $isStoreRequest = true)
    {
        $rules = [];

        // Extract column definitions
        preg_match_all("/->(bigIncrements|increments|uuid|ulid|string|char|text|integer|bigInteger|mediumInteger|tinyInteger|smallInteger|float|double|decimal|boolean|date|dateTime|dateTimeTz|time|timeTz|timestamp|timestampTz|json|enum|set|foreignId)\('([^']+)'\)([^;]*)/", $migrationContent, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $type = $match[1];      // Column type
            $column = $match[2];    // Column name
            $attributes = $match[3]; // Additional attributes (nullable, unique, etc.)

            // Ignore specific columns
            if (in_array($column, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }

            $fieldRules = [];

            // If the column is not nullable, add "required"
            if ($isStoreRequest && !str_contains($attributes, 'nullable')) {
                $fieldRules[] = 'required';
            }

            // If the column is unique, add "unique:$tableName"
            if ($isStoreRequest && str_contains($attributes, 'unique')) {
                $fieldRules[] = "unique:$tableName";
            }

            // Determine rules based on column type
            switch ($type) {
                case 'string':
                case 'char':
                case 'text':
                case 'json':
                    $fieldRules[] = 'string';
                    break;
                case 'integer':
                case 'bigInteger':
                case 'mediumInteger':
                case 'tinyInteger':
                case 'smallInteger':
                case 'foreignId':
                    $fieldRules[] = 'integer';
                    break;
                case 'float':
                case 'double':
                case 'decimal':
                    $fieldRules[] = 'numeric';
                    break;
                case 'boolean':
                    $fieldRules[] = 'boolean';
                    break;
                case 'date':
                case 'dateTime':
                case 'dateTimeTz':
                    $fieldRules[] = 'date';
                    break;
                case 'time':
                case 'timeTz':
                    $fieldRules[] = 'date_format:H:i:s';
                    break;
                case 'uuid':
                case 'ulid':
                    $fieldRules[] = 'uuid';
                    break;
                case 'enum':
                case 'set':
                    preg_match("/enum\('([^']+)'\)/", $attributes, $enumMatch);
                    if (!empty($enumMatch[1])) {
                        $allowedValues = explode(',', str_replace("'", '', $enumMatch[1]));
                        $fieldRules[] = 'in:' . implode(',', $allowedValues);
                    }
                    break;
            }

            // If the column is unique, add "unique:table,column"
            if (str_contains($attributes, 'unique')) {
                $fieldRules[] = "unique:$tableName,$column";
            }

            // Assign the rules
            $rules[$column] = implode('|', $fieldRules);
        }

        return $rules;
    }


    /**
     * Generate request file content.
     *
     * @param string $modelName
     * @param array $rules
     * @param bool $isStoreRequest
     * @return string
     */
    private static function generateRequestContent(string $modelName, array $rules, bool $isStoreRequest)
    {
        $className = $modelName . ($isStoreRequest ? 'StoreRequest' : 'UpdateRequest');

        // Generate rules array as PHP code string
        $rulesArray = var_export($rules, true);
        $rulesArray = str_replace("array (", "[", $rulesArray);
        $rulesArray = str_replace(")", "]", $rulesArray);

        return <<<PHP
<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory as ValidatorFactory;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Support\Facades\DB;

class $className extends Request
{
    protected \$validator;

    public function __construct(ValidatorFactory \$validatorFactory)
    {
        parent::__construct();

        \$this->validator = \$validatorFactory;

        // Manually set the presence verifier with the connection resolver
        \$this->validator->setPresenceVerifier(new DatabasePresenceVerifier(app('db')));
    }

    public function validated()
    {
        \$validator = \$this->validator->make(
            \$this->json()->all(),
            \$this->rules(),
            \$this->messages()
        );

        if (\$validator->fails()) {
            throw new \Illuminate\Validation\ValidationException(\$validator);
        }

        return \$validator->validated();
    }

    public function rules()
    {
        return $rulesArray;
    }

    public function messages()
    {
        return [];
    }
}
PHP;
    }
}
