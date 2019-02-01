<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 15:07
 */

namespace Exception;

class InvalidPhoneLengthException extends \Exception
{
    public function __construct($message = "", $code = 1006, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}