<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idEpiDevolucao']) ? addslashes($dados['idEpiDevolucao']) : '';
    $codigoEmprestimo = isset($dados['codigoDoEmprestimo']) ? addslashes($dados['codigoDoEmprestimo']) : '';
    $devolvido = isset($dados['devolvido']) ? addslashes($dados['devolvido']) : '';
    $quantidade = isset($dados['quantidade']) ? addslashes($dados['quantidade']) : '';

    $listarItem = listarItemExpecifico('*', 'estoque', 'idepi', $id);
    if ($listarItem !== 'Vazio') {
        foreach ($listarItem as $item) {
            $qtdDisponivel = $item->disponivel;

            $result = $qtdDisponivel - $quantidade;

            $retornoUpdate = alterar1Item('estoque', 'disponivel', $result, 'idepi', $id);
            $retornoUpdatePE = $retornoUpdatePE = alterar1ItemDuploWhere('produtoemprestimo', 'devolucao', "$devolvido", 'idepi', "$id", 'codEmprestimo', $codigoEmprestimo);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Epi não encotrado']);
    }
    if ($retornoUpdate > 0) {
        echo json_encode(['success' => true, 'message' => "O status do EPi foi alterado para NÃO DEVOLVIDO!"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Erro! Nenhuma alteracão feita"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
