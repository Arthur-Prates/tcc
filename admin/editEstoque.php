<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idEditEstoque']) ? addslashes($dados['idEditEstoque']) : '';
    $quantidade = isset($dados['quantidadeEstoqueEdit']) ? addslashes($dados['quantidadeEstoqueEdit']) : '';

    $listaEstoque = listarItemExpecifico('*', 'estoque', 'idepi', $id);
    foreach ($listaEstoque as $key) {
        $disponivel = $key->disponivel;

        if ($quantidade < $disponivel) {
            echo json_encode(['success' => false, 'message' => "A quantidade disponível é maior que a quantidade digitada!"]);
            return;
        }

        $listaPedidos = listarItemExpecifico('*','produtoemprestimo','idepi',$id);
        if ($listaPedidos !== 'Vazio'){
            echo json_encode(['success' => false, 'message' => "Este epi não consta no estoque!"]);
            return;
        }

        if ($disponivel == '0') {
            $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel', "$quantidade", "$quantidade", 'idepi', "$id");
        } else {
            $retornoUpdate = alterar1Item('estoque', 'quantidade', "$quantidade", 'idepi', "$id");
        }

        if ($retornoUpdate > 0) {
            echo json_encode(['success' => true, 'message' => "Estoque do Epi alterado com sucesso!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Estoque não alterado!"]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
