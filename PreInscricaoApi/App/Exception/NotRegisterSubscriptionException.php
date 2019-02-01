<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:16
 */

namespace Exception;

class NotRegisterSubscriptionException extends \Exception
{
    public function __construct($message = "", $code = 3001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}