<?php

include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");

$url = (isset($_GET['url'])) ? $_GET['url'] : 'index';
$url = array_filter(explode('/', $url));


//$file = $url[0] . '.php';

//if ($url) {
//    include $file;
//} else {
//    include '404.php';
//}

switch ($url[0]) {
    case 'pagina-inicial':
        include_once('index.php');
        break;
    case 'perfil':
        include_once('perfil.php');
        break;
    case 'aluguel':
        include_once('aluguel.php');
        break;
    case 'carrinho':
        include_once('carrinho.php');
        break;
    case 'fazer-login':
        include_once('logar.php');
        break;
    case 'limparCarrinho':
        include_once('limparCarrinho.php');
        break;
    case 'visualizarAluguel':
        include_once('visualizarAluguel.php');
        break;
    case 'deletarAluguel':
        include_once('deletarAluguel.php');
        break;
    default:
        include_once('404.php');
        break;
}


$controle = filter_input(INPUT_POST, 'controle', FILTER_SANITIZE_STRING);

if (!empty($controle) && isset($controle)) {
    switch ($controle) {
        case 'addAluguel':
            include_once('addAluguel.php');
            break;
        case 'limparCarrinho':
            include_once('limparCarrinho.php');
            break;
        case 'listarAluguel':
            include_once('aluguel.php');
            break;
        case 'visualizarAluguel':
            include_once('visualizarAluguel.php');
            break;
        case 'deletarAluguel':
            include_once('deletarAluguel.php');
            break;
        default:
            include_once('404.php');
            break;
    }
}

