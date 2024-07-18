<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$hora = date('H:i:s');


if (isset($dados) && !empty($dados)) {
    $dataAluguel = isset($dados['dataAluguel']) ? addslashes($dados['dataAluguel']) : '';
    $horaInicial = isset($dados['horaInicialAluguel']) ? addslashes($dados['horaInicialAluguel']) : '';
    $horaFim = isset($dados['horaFinalAluguel']) ? addslashes($dados['horaFinalAluguel']) : '';
    $prioridade = isset($dados['addPrioridade']) ? addslashes($dados['addPrioridade']) : '';
    $observacao = isset($dados['addObservacao']) ? addslashes($dados['addObservacao']) : 'NAO';

    if ($observacao == ''){
        $observacao = 'NAO';
    }

    $data = $dataAluguel;
    $verificaData = validarData($data);

    if ($verificaData != 1 || $dataAluguel < date('Y-m-d')) {
        $dataVerificada = false;
        $msgData = 'Data inválida, favor selecionar uma data válida.';
    } else {
        $dataVerificada = true;
        $msgData = '';
    }

    if ($horaInicial < $hora && $dataAluguel == date('Y-m-d')) {
        $horaInicialVerificada = false;
        $msgHoraInicial = 'A hora inicial não pode ser menor que a atual.';
    } else if ($dataAluguel > date('Y-m-d')) {
        $horaInicialVerificada = true;
        $msgHoraInicial = '';
    } else {
        $horaInicialVerificada = true;
        $msgHoraInicial = '';
    }

    if ($horaFim <= $horaInicial) {
        $horaFimVerificada = false;
        $msgHoraFim = 'A hora final deve ser maior que a inicial.';
    } else {
        $horaFimVerificada = true;
        $msgHoraFim = '';
    }

    if ($dataVerificada == false || $horaInicialVerificada == false || $horaFimVerificada == false) {
        echo json_encode(['success' => false, 'errodata' => true, 'msgData' => $msgData, 'msgHoraInicial' => $msgHoraInicial, 'msgHoraFinal' => $msgHoraFim]);
    }


    if ($dataVerificada == true && $horaInicialVerificada == true && $horaFimVerificada == true) {
        $codigoAluguel = uniqid();
        $limite = 1;
        foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
            $idepi = $produtoCarrinho['idproduto'];
            $quantidade = $produtoCarrinho['quantidade'];
            $qtdDoEstoque = listarItemExpecifico('*', 'estoque', 'idepi', $idepi);
            foreach ($qtdDoEstoque as $item) {
                $quantidadeEstoque = $item->disponivel;
            }
            if ($quantidade <= $quantidadeEstoque) {
                if ($limite == 1) {
                    $insert = insert9Item('aluguel', 'idusuario, dataAluguel, horaInicial, horaFim, codigoAluguel, devolvido, prioridade, observacao, cadastro', "$idFuncionario", "$dataAluguel", "$horaInicial", "$horaFim", "$codigoAluguel", "N", "$prioridade", "$observacao", DATATIMEATUAL);
                }
                $qtdRestante = $quantidadeEstoque - $quantidade;

                $mudandoEstoque = alterar1Item('estoque', 'disponivel', "$qtdRestante", 'idepi', "$idepi");
                $insertProdutoAluguel = insert5Item('produtoAluguel', 'idepi, quantidade, codAluguel, devolucao, cadastro', "$idepi", "$quantidade", "$codigoAluguel", "N", DATATIMEATUAL);
                $sucesso = true;
            } else {
                $sucesso = false;
            }
            ++$limite;
        }
        if ($sucesso) {
            echo json_encode(['success' => true, 'errodata' => false, 'message' => "Produto(s) alugado(s)!"]);
            unset($_SESSION['pedidoscarrinho']);
        } else {
            echo json_encode(['success' => false, 'errodata' => false, 'message' => "Quantidade de produto indisponível!"]);
        }

    }

}