<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);
$hora = date('H:i:s');


if (isset($dados) && !empty($dados)) {
    $dataInicial = isset($dados['dataInicialEmprestimo']) ? addslashes($dados['dataInicialEmprestimo']) : '';
    $dataFinal = isset($dados['dataFinalEmprestimo']) ? addslashes($dados['dataFinalEmprestimo']) : '';
    $prioridade = isset($dados['addPrioridade']) ? addslashes($dados['addPrioridade']) : '';
    $observacao = isset($dados['addObservacao']) ? addslashes($dados['addObservacao']) : '';
    $observacao = isset($dados['addObservacao']) ? trim(strip_tags($dados['addObservacao'])) : '';
    $observacao = preg_replace('/[^a-zA-Z0-9\s]/', '', $observacao);
    if ($observacao == '') {
        $observacao = 'NAO';
    }

    $data = $dataInicial;
    $verificaDataInicial = validarData($data);
    $data2 = $dataFinal;
    $verificaDataFinal = validarData($data2);

    //Bloco data inicial
    if ($verificaDataInicial != 1 || $dataInicial < date('Y-m-d')) {
        $dataInicialVerificada = false;
        $msgDataInicial = 'Data inválida, favor selecionar uma data válida.';
    } else {
        $dataInicialVerificada = true;
        $msgDataInicial = '';
    }
    //----------------------------------
    //bloco data final//////////////
    if ($verificaDataFinal != 1 || $dataFinal < date('Y-m-d') || $dataFinal < $dataInicial) {
        $dataFinalVerificada = false;
        $msgDataFinal = 'Data inválida, favor selecionar uma data válida.';
    } else {
        $dataFinalVerificada = true;
        $msgDataFinal = '';
    }
    //---------------------------------

    if ($dataInicialVerificada == false || $dataFinalVerificada == false) {
        echo json_encode(['success' => false, 'errodata' => true, 'msgDataInicial' => $msgDataInicial, 'msgDataFinal' => $msgDataFinal]);
    }


    if ($dataInicialVerificada == true && $dataFinalVerificada == true) {
        $codigoAluguel = uniqid();
        $limite = 1;
        foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
            $idepi = $produtoCarrinho['idproduto'];
            $quantidade = $produtoCarrinho['quantidade'];
            $qtdDoEstoque = listarItemExpecifico('*', 'estoque', 'idepi', $idepi);
            foreach ($qtdDoEstoque as $item) {
                $quantidadeEstoque = $item->disponivel;
                $descartavel = $item->descartavel;
            }
            if ($quantidade <= $quantidadeEstoque) {
                if ($limite == 1) {
                    $insert = insert8Item('emprestimo', 'idusuario, dataInicialEmprestimo, dataFinalEmprestimo, codigoEmprestimo, devolvido, prioridade, observacao, cadastro', "$idFuncionario", "$dataInicial", "$dataFinal", "$codigoAluguel", "N", "$prioridade", "$observacao", DATATIMEATUAL);
                }
                $qtdRestante = $quantidadeEstoque - $quantidade;

                $mudandoEstoque = alterar1Item('estoque', 'disponivel', "$qtdRestante", 'idepi', "$idepi");
                if ($descartavel == 'N') {
                    $insertProdutoAluguel = insert5Item('produtoemprestimo', 'idepi, quantidade, codEmprestimo, devolucao, cadastro', "$idepi", "$quantidade", "$codigoAluguel", "N", DATATIMEATUAL);
                } else {
                    $insertProdutoAluguel = insert5Item('produtoemprestimo', 'idepi, quantidade, codEmprestimo, devolucao, cadastro', "$idepi", "$quantidade", "$codigoAluguel", "S", DATATIMEATUAL);
                    $result = $quantidadeEstoque - 1;
                    $retornoUpdate = alterar1Item('estoque', 'quantidade', $result, 'idepi', $idepi);
                }
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

}else{
    echo json_encode(['success' => false,'message' => "Nenhum dado recebido!"]);
}