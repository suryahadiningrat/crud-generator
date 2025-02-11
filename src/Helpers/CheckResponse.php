<?php

namespace Suryahadiningrat\CrudGenerator\Helpers;

class CheckResponse
{
    /**
     * Checking response from CRUDGenerator.php.
     *
     * @param array $response
     * @return string|false
     */
    public static function isError(array $response)
    {
        if (isset($response['status']) && isset($response['message']) && $response['status'] == 'error') 
            return $response['message'];

        return false;
    }
}
