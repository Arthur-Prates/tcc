<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");

//$url = $_GET['url'] ?? 'dashboard';
//$url = array_filter(explode('/', $url));
$url = ltrim( parse_url( $_SERVER['REQUEST_URI'] , PHP_URL_PATH ) , '/' );



$router= explode( '/' , $url );

print_r($router);

if ($router[3] == 'admin'){
    echo 'tem admin';
    echo $router[4];
}



//switch ($router[4]) {
//    case 'inicio':
//        include_once("./admin/dashboard.php");
//        break;
//    default:
//        include_once ('404.php');
//        break;
//}