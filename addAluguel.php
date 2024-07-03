<?php
include_once ('./config/conexao.php');
include_once ('./config/constantes.php');
include_once ('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $dataInicio = isset($dados['dataInicioAluguel']) ? addslashes($dados['dataInicioAluguel']) : '';
    $dataFim = isset($dados['dataFimAluguel']) ? addslashes($dados['dataFimAluguel']) : '';
    $prioridade = isset($dados['addPrioridade']) ? addslashes($dados['addPrioridade']) : '';
    $observacao  = isset($dados['addObservacao']) ? addslashes($dados['addObservacao']) : '';

    if ($observacao == ''){
        $observacao = 'NAO';
    }

    if (!isset($_SESSION['pedidoscarrinho'])) {
        echo json_encode(['success' => false, 'message' => "Carrinho Vazio!"]);
    } else {
        $codigoAluguel = uniqid();
        foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
            $idepi = $produtoCarrinho['idproduto'];
            $quantidade = $produtoCarrinho['quantidade'];
            $insert = insert9Item('aluguel', 'idusuario, idepi, quantidade, dataInicio, dataFim, codigoAluguel, prioridade, observacao, cadastro', "$idFuncionario", "$idepi", "$quantidade", "$dataInicio", "$dataFim", "$codigoAluguel", "$prioridade", "$observacao", DATATIMEATUAL);

        }

        echo json_encode(['success' => true, 'message' => "Produto(s) alugado(s)!"]);
        unset($_SESSION['pedidoscarrinho']);

    }


}

//if (!isset($_SESSION['pedidoscarrinho'])) {
//    echo json_encode(['success' => false, 'message' => "Carrinho Vazio!"]);
//} else {
//    $codigoAluguel = uniqid();
//    foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
//        $idepi = $produtoCarrinho['idproduto'];
//        $quantidade = $produtoCarrinho['quantidade'];
//        $insert = insert10Item('aluguel', 'idusuario, idepi, quantidade, dataInicio, dataFim, codigoAluguel, prioridade, observacao, cadastro, ativo', "$idFuncionario", "$idepi", "$quantidade", "$dataInicio", "$dataFim", "$codigoAluguel", "$prioridade", "$observacao", DATATIMEATUAL, 'A');
//
//    }
//
//    echo json_encode(['success' => true, 'message' => "Produto(s) alugado(s)!"]);
//
//}

//$dataInicio = DATATIMEATUAL;
//$dataFim = DATATIMEATUAL;
//$prioridade='ALTA';
//$observacao = 'NAO';


//$dataInicio = filter_input(INPUT_POST, 'dataInicio', FILTER_SANITIZE_STRING);
//$prioridade = filter_input(INPUT_POST, 'prioridade', FILTER_SANITIZE_STRING);
//$dataFim = filter_input(INPUT_POST, 'dataFim', FILTER_SANITIZE_STRING);
//$observacao = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_STRING);