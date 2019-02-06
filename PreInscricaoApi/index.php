<?php
header('Access-Control-Allow-Origin: *');
require_once 'vendor/autoload.php';
require_once 'autoloader.php';
require_once 'config.php';

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Response\ResponseJson;

$config = [
    'settings' => [
            'displayErrorDetails' => false,
        ]
    ];

$app = new Slim\App($config);

// Rota responsável por verificar o Período
$app->get('/periodo', function (){
    try {
        $periodo = new Periodo();
        return $periodo->verificaPeriodo();
    } catch (Exception $ex) {
        return ResponseJson::response([
            "status" => $ex->getCode(),
            "message" => $ex->getMessage()
        ]);
    }
});

// Rota responsável por listar as Unidades
$app->get('/unidades', function (){
    try {
        $unidade = new Unidade();
        return ResponseJson::response([
            "status" => 100,
            "unidade" => $unidade->listarUnidades()
        ]);
    } catch (Exception $ex) {
        return ResponseJson::response([
            "status" => 0,
            "message" => $ex->getMessage()
        ]);
    }
});

// Rota responsável por pegar os dados da Unidade
$app->get('/unidades/{id}', function (Request $request, Response $response, array $args){
    try {
        $id = $args['id'];
        $unidade = new Unidade($id);
        return ResponseJson::response([
            "status" => 100,
            "unidade" => $unidade->buscaUnidade()
        ]);
    } catch (Exception $ex) {
        return ResponseJson::response([
            "status" => 0,
            "message" => $ex->getMessage()
        ]);
    }
});

// Rota responsável por Registrar a Pré-Inscrição
$app->post('/registrar', function () {
    try {
        // Verificando se o Termo de Uso foi aceito
        TermoUso::verifica($_POST['termo'][0]);

        $cliente = new Cliente($_POST['nome'], $_POST['idade'], $_POST['matricula'], $_POST['categoria'], $_POST['telefone'], $_POST['email']);
        $unidade = new Unidade($_POST['unidade']);
        $periodo = new Periodo($_POST['periodo']);
        $questionario = new Questionario($_POST['q']);

        $preinscricao = new PreInscricao($cliente, $unidade, $periodo, $questionario);

        return $preinscricao->salvar();
    } catch (Exception $ex) {
        return ResponseJson::response([
            "status" => 0,
            "message" => $ex->getMessage()
        ]);
    }
});

$app->run();