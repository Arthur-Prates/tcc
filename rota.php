<?php
//include_once("./config/constantes.php");
//include_once("./config/conexao.php");
//include_once("./func/funcoes.php");

$url = $_GET['url'] ?? 'erro';
$url = array_filter(explode('/', $url));

switch ($url[0]) {
    case 'pagina-inicial':
        include_once('index.php');
        break;
    case 'meu-perfil':
        include_once('perfil.php');
        break;
    case 'meus-emprestimos':
        include_once('emprestimo.php');
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
    case 'visualizar-emprestimo':
        include_once('visualizarEmprestimo.php');
        break;
    case 'logout':
        include_once('logout.php');
        break;
    case 'resultado-da-busca':
        include_once('resultadoPesquisa.php');
        break;
    default:
        include_once('404.php');
        break;
}
