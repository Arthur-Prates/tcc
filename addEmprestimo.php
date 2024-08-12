<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$hora = date('H:i:s');


if (isset($dados) && !empty($dados)) {
    $dataEmprestimo = isset($dados['dataAluguel']) ? addslashes($dados['dataAluguel']) : '';
    $horaInicial = isset($dados['horaInicialAluguel']) ? addslashes($dados['horaInicialAluguel']) : '';
    $horaFim = isset($dados['horaFinalAluguel']) ? addslashes($dados['horaFinalAluguel']) : '';
    $prioridade = isset($dados['addPrioridade']) ? addslashes($dados['addPrioridade']) : '';
    $observacao = isset($dados['addObservacao']) ? addslashes($dados['addObservacao']) : '';

    if ($observacao == ''){
        $observacao = 'NAO';
    }

    $data = $dataEmprestimo;
    $verificaData = validarData($data);

    if ($verificaData != 1 || $dataEmprestimo < date('Y-m-d')) {
        $dataVerificada = false;
        $msgData = 'Data inválida, favor selecionar uma data válida.';
    } else {
        $dataVerificada = true;
        $msgData = '';
    }

    if ($horaInicial < $hora && $dataEmprestimo == date('Y-m-d')) {
        $horaInicialVerificada = false;
        $msgHoraInicial = 'A hora inicial não pode ser menor que a atual.';
    } else if ($dataEmprestimo > date('Y-m-d')) {
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
                    $insert = insert9Item('emprestimo', 'idusuario, dataEmprestimo, horaInicial, horaFim, codigoEmprestimo, devolvido, prioridade, observacao, cadastro', "$idFuncionario", "$dataEmprestimo", "$horaInicial", "$horaFim", "$codigoAluguel", "N", "$prioridade", "$observacao", DATATIMEATUAL);
                }
                $qtdRestante = $quantidadeEstoque - $quantidade;

                $mudandoEstoque = alterar1Item('estoque', 'disponivel', "$qtdRestante", 'idepi', "$idepi");
                $insertProdutoAluguel = insert5Item('produtoemprestimo', 'idepi, quantidade, codEmprestimo, devolucao, cadastro', "$idepi", "$quantidade", "$codigoAluguel", "N", DATATIMEATUAL);
                $sucesso = true;
            } else {
                $sucesso = false;
            }
            ++$limite;
        }
        if ($sucesso) {
            echo json_encode(['success' => true, 'errodata' => false, 'message' => "Empréstimo relizado com sucesso!"]);
            unset($_SESSION['pedidoscarrinho']);
        } else {
            echo json_encode(['success' => false, 'errodata' => false, 'message' => "Quantidade de produto indisponível!"]);
        }

    }

}