<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:31
 */

namespace Exception;

class NotRegisterClientException extends \Exception
{
    public function __construct($message = "", $code = 1008, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}