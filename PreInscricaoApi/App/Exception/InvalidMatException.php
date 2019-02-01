<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 14:57
 */

namespace Exception;

class InvalidMatException extends \Exception
{
    public function __construct($message = "", $code = 1003, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}