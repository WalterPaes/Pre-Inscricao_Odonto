<?php
/**
 * Created by PhpStorm.
 * User: 4583
 * Date: 28/01/2019
 * Time: 17:27
 */

use Response\ResponseJson;
use Exception\InvalidQuestionException;

class Questionario
{
    private $respostas;

    public function __construct(array $respostas)
    {
        $this->setRespostas($respostas);
    }

    public function getRespostas()
    {
        return $this->respostas;
    }

    private function setRespostas($respostas)
    {
        try {
            for ($i = 1; $i < count($respostas); $i++) {

                $resposta = filter_var($respostas[$i][0], FILTER_SANITIZE_NUMBER_INT);

                if (!filter_var($resposta, FILTER_VALIDATE_INT, ["min_range" => 1, "max_range" => 4])) {
                    throw new InvalidQuestionException("Resposta inválida para a questão " . ($i + 1) . "!");
                }

                $this->respostas[] = $resposta;
            }

            // Transformando o Array em uma String
            $this->respostas = implode(',', $this->respostas);

        } catch (InvalidQuestionException $ex) {
            echo ResponseJson::response([
                "status" => $ex->getCode(),
                "message" => $ex->getMessage()
            ]);
        }
    }


}