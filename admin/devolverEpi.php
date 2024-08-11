<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idEpiDevolucao']) ? addslashes($dados['idEpiDevolucao']) : '';
    $valor = isset($dados['devolvido']) ? addslashes($dados['devolvido']) : '';
    $codEmprestimo = isset($dados['codigoDoEmprestimo']) ? addslashes($dados['codigoDoEmprestimo']) : '';
    $qtdDevolucao = isset($dados['quantidade']) ? addslashes($dados['quantidade']) : '';
    $observacao = isset($dados['observacaoSobreOEpi']) ? addslashes($dados['observacaoSobreOEpi']) : '';
    $condicaoEpi = isset($dados['situacaoEpi']) ? addslashes($dados['situacaoEpi']) : '';
    $status = isset($dados['opcao']) ? addslashes($dados['opcao']) : '';

    if ($condicaoEpi === 'bomEstado') {
        $retornoInsert = alterar1ItemDuploWhere('produtoemprestimo', 'devolucao', "$valor", 'idepi', "$id", 'codEmprestimo', $codEmprestimo);
        $listarItem = listarItemExpecifico('*', 'estoque', 'idepi', $id);
        if ($valor === 'S') {
            if ($listarItem !== 'Vazio') {
                foreach ($listarItem as $item) {
                    $qtdDisponivel = $item->disponivel;
                    $result = $qtdDisponivel + $qtdDevolucao;
                    $retornoUpdate = alterar1Item('estoque', 'disponivel', $result, 'idepi', $id);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Epi não encotrado']);
            }
            if ($retornoInsert > 0) {
                echo json_encode(['success' => true, 'message' => "O EPI foi devolvido com sucesso"]);
            } else {
                echo json_encode(['success' => false, 'message' => "Erro! O EPI já foi devolvido! Nenhuma alteracão feita"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Erro!"]);
        }
    } else {
        if ($status == '') {
            echo json_encode(['success' => false, 'message' => 'erro']);
        } else {
            $retornoInsert = insert6Item('epidanificado', 'idepi, codigoDoEmprestimo, observacao, statusEpi, quantidade, cadastro', "$id", "$codEmprestimo", "$observacao", "$status", 1, DATATIMEATUAL);

            $tabelaEstoque = listarItemExpecifico('*', 'estoque', 'idepi', $id);
            foreach ($tabelaEstoque as $itemEstoque) {
                $quantidadeTotal = $itemEstoque->quantidade;
                $disponivel = $itemEstoque->disponivel;
                $qtdTotalResultado = $quantidadeTotal - 1;
                $qtdDisponivelResultado = $disponivel - 1;
            }

            $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel', $qtdTotalResultado, $qtdDisponivelResultado, 'idepi', $id);
            $retornoUpdatePE = alterar1ItemDuploWhere('produtoemprestimo', 'devolucao', "$valor", 'idepi', "$id", 'codEmprestimo', $codEmprestimo);

            if ($retornoUpdate > 0 && $retornoInsert > 0) {
                if ($status == 2) {
                    echo json_encode(['success' => true, 'message' => "O EPI foi devolvido com sucesso e será enviado para manutenção!"]);
                } else if ($status == 3) {
                    echo json_encode(['success' => true, 'message' => "O EPI foi devolvido com sucesso e será substituído!"]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Ocorreu um erro ao devolver o EPI, contate o suporte!']);
            }
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
