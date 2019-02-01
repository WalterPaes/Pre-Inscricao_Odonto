<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:48
 */

namespace Exception;

class NotUpdateClientException extends \Exception
{
    public function __construct($message = "", $code = 1009, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}