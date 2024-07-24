<?php
include_once("./config/constantes.php");
include_once("./config/conexao.php");
include_once("./func/funcoes.php");

//$url = $_GET['url'] ?? 'index';
//$url = array_filter(explode('/', $url));


$url = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$router = explode('/', $url);

if ($router[2] === 'admin') {
    echo $router[2];
    switch ($router[3]) {
        case 'admin/inicio':
            include_once("./admin/dashboard.php");
            break;
        case 'admin/visualizar-emprestimo':
            include_once("./admin/verificarAluguel.php");
            break;
        default:
            include_once('./admin/404.php');
            break;
    }
}else{
    switch ($router[2]) {
        case 'pagina-inicial':
            include_once('index.php');
            break;
        case 'meu-perfil':
            include_once('perfil.php');
            break;
        case 'meus-alugueis':
            include_once('aluguel.php');
            break;
        case 'carrinho':
            include_once('carrinho.php');
            break;
        case 'fazer-login':
            include_once('logar.php');
            break;
        case 'alterar-senha':
            include_once('alterarSenha.php');
            break;
        case 'visualizar-aluguel':
            include_once('visualizarAluguel.php');
            break;
        case 'logout':
            include_once('logout.php');
            break;
        case 'resultado-da-busca':
            include_once('resultadoPesquisa.php');
            break;
        case 'inicio':
            include_once('./admin/dashboard.php');
            break;
        default:
            include_once('404.php');
            break;
    }

}



