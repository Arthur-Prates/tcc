<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

header('Content-Type: application/json');

if (!isset($_SESSION['pedidoscarrinho'])) {
    $_SESSION['pedidoscarrinho'] = array();
}


$totalItem = count($_SESSION['pedidoscarrinho']);

echo json_encode(['carrinho' => $_SESSION['pedidoscarrinho'], 'qtdTotalCarrinho' => $totalItem]);