<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 01/02/2019
 * Time: 10:39
 */

namespace Exception;

use Throwable;

class InvalidCategoryException extends \Exception
{
    public function __construct($message = "", $code = 1005, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}