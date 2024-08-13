<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//echo json_encode($retornoUpdate);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $codEmprestimo = isset($dados['codEmprestimo']) ? addslashes($dados['codEmprestimo']) : '';
    $valor = isset($dados['valor']) ? addslashes($dados['valor']) : '';
    $retornoUpdate = alterar1Item('emprestimo', 'devolvido', "$valor", 'codigoEmprestimo', $codEmprestimo);
    if ($valor == 'S') {
        if ($retornoUpdate > 0) {
            echo json_encode(['success' => true, 'message' => "O empréstimo foi devolvido com sucesso"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! O empréstimo já foi devolvido! Nenhuma alteracão feita"]);
        }
    } else {
        if ($retornoUpdate > 0) {
            echo json_encode(['success' => true, 'message' => "O status do empréstimo foi alterado para NÃO DEVOLVIDO!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! Nenhuma alteracão feita"]);
        }
    }


} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}