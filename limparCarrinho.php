<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

unset($_SESSION['pedidoscarrinho']);

echo json_encode(['success' => true, 'message' => "Carrinho limpo com sucesso!"]);