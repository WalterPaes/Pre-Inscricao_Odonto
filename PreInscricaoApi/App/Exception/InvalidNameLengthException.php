<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 14:41
 */

namespace Exception;

class InvalidNameLengthException extends \Exception
{
    public function __construct($message = "", $code = 1001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}