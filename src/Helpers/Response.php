<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class Response
{
    /**
     * Creating response
     *
     * @param string $message
     * @return array
     */
    public static function createError(string $message)
    {
        return [
            'status' => 'error',
            'message' => $message
        ];
    }
}
