<?php

include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");
$controle = filter_input(INPUT_POST, 'controle', FILTER_SANITIZE_STRING);


if (!empty($controle) && isset($controle)) {
    switch ($controle) {
        case 'pagina-1':
            include_once('teste.php');
            break;
        case 'listarEpi':
            include_once 'admin/epi.php';
            break;
        case 'listarAluguel':
            include_once 'admin/aluguel.php';
            break;
        case 'listarUsuario':
            include_once 'admin/usuario.php';
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
//$file = $url[0] . '.php';
//
//if (is_file($file)) {
//    include $file;
//} else {
//    include '404.php';
//}
//