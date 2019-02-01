<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:24
 */

namespace Exception;

class NotHavePeriodsException extends \Exception
{
    public function __construct($message = "", $code = 2002, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}