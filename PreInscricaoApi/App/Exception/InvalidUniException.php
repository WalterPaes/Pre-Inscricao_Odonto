<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:02
 */

namespace Exception;

class InvalidUniException extends \Exception
{
    public function __construct($message = "", $code = 6001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}