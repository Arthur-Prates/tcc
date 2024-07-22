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
        foreach ($_SESSION['pedidoscarrinho'] as $index => &$produtoCarrinho) {
            if ($produtoCarrinho['idproduto'] == $id) {
                $indice = $index;
                unset($_SESSION['pedidoscarrinho'][$indice]);
                $_SESSION['pedidoscarrinho'] = array_values($_SESSION['pedidoscarrinho']);
                $cont = count($_SESSION['pedidoscarrinho']);
                echo json_encode(['success' => true, 'message' => "Produto retirado do carrinho", 'qtd' => $cont]);
                break;
            }
        }
    }
}
