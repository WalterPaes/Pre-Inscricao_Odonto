<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 01/02/2019
 * Time: 14:25
 */

spl_autoload_register(function ($class){
    require_once 'App/' . str_replace('\\', '/', $class) . '.php';
});