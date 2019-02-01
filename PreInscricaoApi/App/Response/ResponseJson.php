<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 15:41
 */

namespace Response;

class ResponseJson implements ResponseInterface
{
    public static function response(array $response)
    {
        // TODO: Implement response() method.
        return json_encode($response);
    }
}