<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 14:43
 */

namespace Exception;

class InvalidAgeException extends \Exception
{
    public function __construct($message = "", $code = 1002, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}