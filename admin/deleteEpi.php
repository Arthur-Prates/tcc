<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idDelete']) ? addslashes($dados['idDelete']) : '';


    $verificarVazio = listarItemExpecifico('*', 'estoque', 'idepi', "$id");

    foreach ($verificarVazio as $item) {
        $quantidade = $item->quantidade;
        $disponivel = $item->disponivel;
        if ($disponivel != $quantidade) {
            echo json_encode(['success' => false, 'message' => "Epi em Uso"]);
        } else {
            $retornoInsert = deletarCadastro('epi', 'idepi', "$id");
            if ($retornoInsert > 0) {
                echo json_encode(['success' => true, 'message' => "Epi deletado com sucesso"]);
            } else {
                echo json_encode(['success' => false, 'message' => "Epi não deletado!"]);
            }
        }


    }

}else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}