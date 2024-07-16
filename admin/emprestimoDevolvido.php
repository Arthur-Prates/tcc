<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$a = print_r($dados, true);

//echo json_encode(['success' => false, 'message' => "$a"]);

if (isset($dados) && !empty($dados)) {
    $codAluguel = isset($dados['codAluguel']) ? addslashes($dados['codAluguel']) : '';
    $valor = isset($dados['valor']) ? addslashes($dados['valor']) : '';

    $retornoUpdate = alterar1Item('aluguel', 'devolvido', "$valor",  'codigoAluguel', $codAluguel);
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