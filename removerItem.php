<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);

unset($_SESSION['pedidoscarrinho'][$dados]);
//$_SESSION['pedidoscarrinho'] = array_values($_SESSION['pedidoscarrinho']);
echo json_encode(['success' => true, 'message' => "Produto retirado do carrinho"]);
