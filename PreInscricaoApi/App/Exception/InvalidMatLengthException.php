<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 14:53
 */

namespace Exception;

class InvalidMatLengthException extends \Exception
{
    public function __construct($message = "", $code = 1004, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}