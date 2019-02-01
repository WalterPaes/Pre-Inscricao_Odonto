<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 30/01/2019
 * Time: 17:51
 */

namespace Helper;


class DateTimeHelper
{
    public static function getTimeStamp($data){
        $dia = (int) substr($data, 8, 2);
        $mes = (int) substr($data, 5, 2);
        $ano = (int) substr($data, 0, 4);

        $hora = (int) substr($data, 11, 2);
        $minuto = (int) substr($data, 14, 2);
        $segundos = (int) substr($data, 17, 2);

        return mktime($hora, $minuto, $segundos, $mes, $dia, $ano);
    }
}