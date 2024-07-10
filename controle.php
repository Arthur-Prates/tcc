<?php
include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");

$controle = filter_input(INPUT_POST, 'controle', FILTER_SANITIZE_STRING);

//echo $controle;
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
        case 'editSenha':
            include_once('editarSenha.php');
            break;
        case 'editDados':
            include_once('editDados.php');
            break;
        default:
            include_once('404.php');
            break;
    }
}

