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
    $codEmprestimo = isset($dados['codEmprestimo']) ? addslashes($dados['codEmprestimo']) : '';
    $qtdDevolucao = isset($dados['qtdDevolucao']) ? addslashes($dados['qtdDevolucao']) : '';



    $retornoInsert = alterar1ItemDuploWhere('produtoemprestimo', 'devolucao', "$valor", 'idepi', "$id", 'codEmprestimo', $codEmprestimo);
    if ($valor == 'S') {
        $listarItem = listarItemExpecifico('*','estoque','idepi',$id);
        if ($listarItem !== 'Vazio'){
            foreach ($listarItem as $item){
                $qtdDisponivel = $item -> disponivel;

                $result = $qtdDisponivel + $qtdDevolucao;

                $retornoUpdate = alterar1Item('estoque', 'disponivel', $result,'idepi', $id);
            }
        }else{
            echo json_encode(['success' => false, 'message' => 'Epi não encotrado']);
        }
        if ($retornoInsert > 0) {
            echo json_encode(['success' => true, 'message' => "O EPI foi devolvido com sucesso"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! O EPI já foi devolvido! Nenhuma alteracão feita"]);
        }
    } else {
        $listarItem = listarItemExpecifico('*','estoque','idepi',$id);
        if ($listarItem !== 'Vazio'){
            foreach ($listarItem as $item){
                $qtdDisponivel = $item -> disponivel;

                $result = $qtdDisponivel - $qtdDevolucao;

                $retornoUpdate = alterar1Item('estoque', 'disponivel', $result,'idepi', $id);
            }
        }else{
            echo json_encode(['success' => false, 'message' => 'Epi não encotrado']);
        }
        if ($retornoInsert > 0) {
            echo json_encode(['success' => true, 'message' => "O status do EPi foi alterado para NÃO DEVOLVIDO!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro! Nenhuma alteracão feita"]);
        }
    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}