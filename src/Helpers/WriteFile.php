<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

use Symfony\Component\Filesystem\Filesystem;

class WriteFile
{
    /**
     * Writing content file.
     *
     * @param string $filePath
     * @param string $fileName
     * @param string $content
     * @return bool
     */
    public static function write(string $filePath, string $fileName, string $content)
    {
        $path = $filePath.'/'.$fileName;
        $filesystem = new Filesystem();
        $filesystem->dumpFile($path, $content);
    }
}
