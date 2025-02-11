<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

use Illuminate\Support\Facades\File;

class ReadFile
{
    /**
     * Reading content of file.
     *
     * @param string $filePath
     * @return string|false
     */
    public static function read($filePath)
    {
        try {
            return File::get($filePath);
        } catch (\Exception $e) {
            return false;
        }
    }
}
