<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 15:32
 */

namespace Exception;

class InvalidEmailException extends \Exception
{
    public function __construct($message = "", $code = 1007, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}