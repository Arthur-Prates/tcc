<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);

$produto = listarTabelaInnerJoinOrdenadaExpecifica('*', 'epi', 'estoque', 'idepi', 'idepi', 'a.idepi', $dados, "a.idepi", "ASC");


if ($produto !== false) {
    foreach ($produto as $item) {
        $id = $item->idepi;
        $estoque = $item->quantidade;

        if ($estoque > 0) {
            foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
                if ($produtoCarrinho['idproduto'] == $id) {
                    $produtoCarrinho['quantidade'] += 1;
                    echo json_encode(['success' => true, 'message' => "Quantidade do produto aumentada!"]);
                    break;
                }
            }
        }


    }
    $cont = count($_SESSION['pedidoscarrinho']);

} else {
    $cont = count($_SESSION['pedidoscarrinho']);
    echo json_encode(['success' => false, 'message' => "Erro ao adicionar produto!",  'qtd' => $cont]);
}

