<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:09
 */

namespace Exception;

class InvalidPeriodException extends \Exception
{
    public function __construct($message = "", $code = 2001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}