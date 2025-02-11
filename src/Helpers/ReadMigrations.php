<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

use Illuminate\Support\Facades\File;

class ReadMigrations
{
    /**
     * Reading content of file migrations.
     *
     * @param string $filePath
     * @return string|false
     */
    public static function readFile($filePath)
    {
        try {
            return File::get($filePath);
        } catch (\Exception $e) {
            return false;
        }
    }
}
