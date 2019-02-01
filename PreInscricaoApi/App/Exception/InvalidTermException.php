<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:19
 */

namespace Exception;

class InvalidTermException extends \Exception
{
    public function __construct($message = "", $code = 5001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}