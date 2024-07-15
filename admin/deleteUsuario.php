<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$a = print_r($dados, true);

//echo json_encode(['success' => false, 'message' => "$a"]);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idDelete']) ? addslashes($dados['idDelete']) : '';

        $retornoInsert = deletarCadastro('usuario', 'idusuario', "$id");
        if ($retornoInsert > 0) {
            echo json_encode(['success' => true, 'message' => "Usuário deletado com sucesso"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Usuário não deletado!"]);
        }


}else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}