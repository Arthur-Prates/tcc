<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$a = print_r($dados, true);

//echo json_encode(['success' => false, 'message' => "$a"]);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idDevolucao']) ? addslashes($dados['idDevolucao']) : '';
    $valor = isset($dados['valor']) ? addslashes($dados['valor']) : '';
    $codAluguel = isset($dados['codAluguel']) ? addslashes($dados['codAluguel']) : '';


    $retornoInsert = alterar1ItemDuploWhere('produtoAluguel', 'devolucao', "$valor", 'idepi', "$id", 'codAluguel', $codAluguel);
    if ($valor == 'S') {
        if ($retornoInsert > 0) {
            echo json_encode(['success' => true, 'message' => "O EPI foi devolvido com sucesso"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! O EPI já foi devolvido! Nenhuma alteracão feita"]);
        }
    } else {
        if ($retornoInsert > 0) {
            echo json_encode(['success' => true, 'message' => "O status do EPi foi alterado para NÃO DEVOLVIDO!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! Nenhuma alteracão feita"]);
        }
    }


} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}