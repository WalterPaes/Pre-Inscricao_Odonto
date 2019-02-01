<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 31/01/2019
 * Time: 12:18
 */

use Response\ResponseJson;
use Exception\InvalidTermException;

class TermoUso
{
    public static function verifica($termo)
    {
        try {
            // Fazendo o Filtro do parâmetro
            $termo = filter_var($termo, FILTER_SANITIZE_NUMBER_INT);
            if (!filter_var($termo, FILTER_VALIDATE_INT)) {
                throw new InvalidTermException("Você precisa aceitar o Termo de Uso!");
            }
        } catch (InvalidTermException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }
}