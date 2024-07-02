<?php
include_once ('./config/conexao.php');
include_once ('./config/constantes.php');
include_once ('./func/funcoes.php');
$idusuario = 1;

//$dataInicio = filter_input(INPUT_POST, 'dataInicio', FILTER_SANITIZE_STRING);
//$prioridade = filter_input(INPUT_POST, 'prioridade', FILTER_SANITIZE_STRING);
//$dataFim = filter_input(INPUT_POST, 'dataFim', FILTER_SANITIZE_STRING);
//$observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_STRING);
//echo json_encode($dados);
$dataInicio = DATATIMEATUAL;
$dataFim = DATATIMEATUAL;
$prioridade='ALTA';
$observacao = 'NAO';

if (!isset($_SESSION['pedidoscarrinho'])) {
    echo json_encode(['success' => false, 'message' => "Carrinho Vazio!"]);
} else {
    $codigoAluguel = uniqid();
    foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
        $idepi = $produtoCarrinho['idproduto'];
        $quantidade = $produtoCarrinho['quantidade'];
        $insert = insert10Item('aluguel', 'idusuario, idepi, quantidade, dataInicio, dataFim, codigoAluguel, prioridade, observacao, cadastro, ativo', "$idusuario", "$idepi", "$quantidade", "$dataInicio", "$dataFim", "$codigoAluguel", "$prioridade", "$observacao", DATATIMEATUAL, 'A');

    }

    echo json_encode(['success' => true, 'message' => "Produto(s) comprado(s)!"]);

}

