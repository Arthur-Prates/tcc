<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$hora = date('h:i');


if (isset($dados) && !empty($dados)) {
    $dataAluguel = isset($dados['dataAluguel']) ? addslashes($dados['dataAluguel']) : '';
    $horaInicial = isset($dados['horaInicialAluguel']) ? addslashes($dados['horaInicialAluguel']) : '';
    $horaFim = isset($dados['horaFinalAluguel']) ? addslashes($dados['horaFinalAluguel']) : '';
    $prioridade = isset($dados['addPrioridade']) ? addslashes($dados['addPrioridade']) : '';
    $observacao = isset($dados['addObservacao']) ? addslashes($dados['addObservacao']) : '';

    if ($observacao == '') {
        $observacao = 'NAO';
    }

    if ($dataAluguel !== date('Y-m-d') || $dataAluguel < date('Y-m-d')) {
        echo json_encode(['success' => false, 'errodata' => true, 'dataErrada' => true, 'horaInicial' => false, 'horaFinal' => false, 'mensagem' => 'Data inválida, favor selecionar uma data válida']);
    } else if ($horaInicial < $hora) {
        echo json_encode(['success' => false, 'errodata' => true, 'dataErrada' => false, 'horaInicial' => true, 'horaFinal' => false, 'mensagem' => 'A hora inicial do aluguel não pode ser menor que a atual!']);
    } else if ($horaFim <= $horaInicial) {
        echo json_encode(['success' => false, 'errodata' => true, 'dataErrada' => false, 'horaInicial' => false, 'horaFinal' => true, 'mensagem' => 'A hora final deve ser maior que a inicial!']);
    } else {
        $codigoAluguel = uniqid();
        foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
            $idepi = $produtoCarrinho['idproduto'];
            $quantidade = $produtoCarrinho['quantidade'];
            $insert = insert11Item('aluguel', 'idusuario, idepi, quantidade, dataAluguel, horaInicial, horaFinal, codigoAluguel, devolvido, prioridade, observacao, cadastro', "$idFuncionario", "$idepi", "$quantidade", "$dataAluguel", "$horaInicial", "$horaFim", "$codigoAluguel", "N", "$prioridade", "$observacao", DATATIMEATUAL);

        }
        echo json_encode(['success' => true, 'errodata' => false, 'message' => "Produto(s) alugado(s)!"]);
        unset($_SESSION['pedidoscarrinho']);
    }

}


//$horaInicial = $dados['horaInicialAluguel'];
//$horaFinal = $dados['horaFinalAluguel'];
//$dataConfirmacao = $dados['dataAluguel'];

//if ($dataConfirmacao !== date('Y-m-d')) {
//    echo json_encode(['Dados recebidos' => $dados, 'Hora' => $hora, 'Mensagem' => 'Formato de data inválido']);
//} else {
//    if ($horaInicial < $hora) {
//        echo json_encode(['Dados recebidos' => $dados, 'Hora' => $hora, 'Mensagem' => 'A hora inicial do aluguel não pode ser menor que a atual!']);
//    } else {
//        if ($horaFinal <= $horaInicial) {
//            echo json_encode(['Dados recebidos' => $dados, 'Hora' => $hora, 'Mensagem' => 'A hora final deve ser maior que a inicial!']);
//        } else {
//            echo json_encode(['Dados recebidos' => $dados, 'Hora' => $hora, 'Mensagem' => 'Tudo certo']);
//        }
//    }
//
//}


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