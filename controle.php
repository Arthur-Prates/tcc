<?php

include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");

$controle = filter_input(INPUT_POST, 'controle', FILTER_SANITIZE_STRING);


if (!empty($controle) && isset($controle)) {
    switch ($controle) {
        case 'addAluguel':
            include_once 'addAluguel.php';
            break;
        case 'limparCarrinho':
            include_once 'limparCarrinho.php';
            break;
        case 'listarAluguel':
            include_once 'aluguel.php';
            break;
        case 'visualizarAluguel':
            include_once 'visualizarAluguel.php';
            break;
    }
} else {
    ?>
    <div style="display: flex;justify-content: center;align-items: center; min-height: 95vh !important;">
        <h1>Página Vazia, Retorne. </h1><sup>Error 404</sup>
        <img src="img/vazio.gif" alt="ERROR 404">
    </div>
    <?php

}

//
//$url = (isset($_GET['url'])) ? $_GET['url'] : 'dashboard.php';
//$url = array_filter(explode('/', $url));
//
//$file = $url[0] . 'upload.php';
//
//if (is_file($file)) {
//    include $file;
//} else {
//    include '404.php';
//}
//