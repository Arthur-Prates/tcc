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
    $condicaoEpi = isset($dados['situacaoEpi']) ? addslashes($dados['situacaoEpi']) : '';


    if ($condicaoEpi == 'bomEstado') {
        $retornoInsert = alterar1ItemDuploWhere('produtoemprestimo', 'devolucao', "$valor", 'idepi', "$id", 'codEmprestimo', $codEmprestimo);
        $listarItem = listarItemExpecifico('*', 'estoque', 'idepi', $id);
        if ($valor == 'S') {
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
            if ($listarItem !== 'Vazio') {
                foreach ($listarItem as $item) {
                    $qtdDisponivel = $item->disponivel;

                    $result = $qtdDisponivel - $qtdDevolucao;

                    $retornoUpdate = alterar1Item('estoque', 'disponivel', $result, 'idepi', $id);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Epi não encotrado']);
            }
            if ($retornoInsert > 0) {
                echo json_encode(['success' => true, 'message' => "O status do EPi foi alterado para NÃO DEVOLVIDO!"]);
            } else {
                echo json_encode(['success' => false, 'message' => "Erro! Nenhuma alteracão feita"]);
            }
        }

    } else {
        echo json_encode('ta aqui hein');
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
