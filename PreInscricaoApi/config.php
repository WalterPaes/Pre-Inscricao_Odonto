<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 01/02/2019
 * Time: 14:23
 */

use Response\ResponseJson;

setlocale(LC_ALL, 'pt_BR');
date_default_timezone_set("America/Belem");

error_reporting(E_ALL & ~E_NOTICE);
set_error_handler('setErrorHandler');

function setErrorHandler($code, $message, $file, $line, $context)
{
    echo ResponseJson::response([
        "status" => $code,
        "message" => $message
    ]);
}