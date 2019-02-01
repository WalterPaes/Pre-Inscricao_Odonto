<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 01/02/2019
 * Time: 10:31
 */

namespace Helper;

class TemplateHelper
{
    public static function render($template, $params = array())
    {
        $template = file_get_contents("App/Templates/{$template}.html");

        foreach ($params as $key => $value) {
            $template = str_replace($key, $value, $template);
        }

        return $template;
    }
}