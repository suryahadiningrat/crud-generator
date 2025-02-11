<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class Response
{
    /**
     * Creating response error
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

    /**
     * Creating response success
     *
     * @param string $message
     * @return array
     */
    public static function createSuccess(string $message)
    {
        return [
            'status' => 'success',
            'message' => $message
        ];
    }
}
