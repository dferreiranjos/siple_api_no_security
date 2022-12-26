<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

$path = (isset($_GET['path']) ? explode('/', $_GET['path']) : 'O caminho não existe');


if(isset($path[0])){$api = $path[0];}else{echo 'O caminho não existe'; exit;}
if(isset($path[1])){$acao = $path[1];}else{$acao = '';}
if(isset($path[1])){$param = $path[2];}else{$param = '';}

$method = $_SERVER['REQUEST_METHOD'];

require_once "classes/db.class.php";
require_once "classes/clientes.class.php";






// **********************************************************


// $GLOBALS['secretJWT'] = '123456';

// # Autoload

// include_once "classes/autoload.class.php";
// new Autoload();

// # Rotas

// $rota = new Rotas();
// $rota->add('POST', '/usuarios/login', 'Usuarios::login', false);
// $rota->add('GET', '/clientes/listar', 'Clientes::listarTodos', true);
// $rota->add('GET', '/clientes/listar/[PARAM]', 'Clientes::listarUnico', true);
// $rota->add('PUT', '/clientes/atualizar/[PARAM]', 'Clientes::atualizar', true);
// $rota->ir($_GET['path']);
