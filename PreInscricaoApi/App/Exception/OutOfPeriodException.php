<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:55
 */

namespace Exception;

class OutOfPeriodException extends \Exception
{
    public function __construct($message = "", $code = 2003, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}