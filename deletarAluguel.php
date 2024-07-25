<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $idAluguel = isset($dados['idDeleteAluguel']) ? addslashes($dados['idDeleteAluguel']) : '';

    $retornoDelete = deletarCadastro('aluguel', 'idaluguel', "$idAluguel");

    if ($retornoDelete) {
        echo json_encode(['success' => true, 'message' => "Aluguel deletado com sucesso!"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Aluguel não deletado!"]);
    }

}