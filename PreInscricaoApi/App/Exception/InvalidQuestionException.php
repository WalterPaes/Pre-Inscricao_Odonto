<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 17:02
 */

namespace Exception;

class InvalidQuestionException extends \Exception
{
    public function __construct($message = "", $code = 4001, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}