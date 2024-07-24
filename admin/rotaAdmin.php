<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");

$url = $_GET['url'] ?? 'erro';
$url = array_filter(explode('/', $url));

switch ($url[0]) {
    case 'inicio':
        include_once("dashboard.php");
        break;
    case 'visualizar-emprestimo':
        include_once("verificarAluguel.php");
        break;
    case 'sair':
        include_once("logout.php");
        break;
    case 'login':
        include_once("index.php");
        break;
    default:
        include_once('404.php');
        break;
}
