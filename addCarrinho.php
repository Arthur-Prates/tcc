<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);

if (!isset($_SESSION['pedidoscarrinho'])) {
    $_SESSION['pedidoscarrinho'] = array();
}

$produtoADD = false;
$produto = listarTabelaInnerJoinOrdenadaExpecifica('*', 'epi', 'estoque', 'idepi', 'idepi', 'a.idepi', $dados, "a.idepi", "ASC");


if ($produto !== false) {
    foreach ($produto as $item) {
        $id = $item->idepi;
        $nomeEpi = $item->nomeEpi;
        $foto = $item->foto;
        $codigo = $item->certificado;
        $estoque = $item->quantidade;

        if ($estoque > 0) {
            foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
                if ($produtoCarrinho['idproduto'] == $id) {
                    $produtoCarrinho['quantidade'] += 1;
                    $produtoADD = true;
                    break;
                }
            }
            if (!$produtoADD) {
                array_push(
                    $_SESSION['pedidoscarrinho'],
                    array(
                        'idproduto' => $id,
                        'nome' => $nomeEpi,
                        'foto' => $foto,
                        'certificado' => $codigo,
                        'quantidade' => 1
                    )
                );
            }
        }


    }
    $cont = count($_SESSION['pedidoscarrinho']);
    if ($produtoADD) {
        echo json_encode(['success' => true, 'message' => "Quantidade do produto aumentada!", 'qtd' => $cont]);
    } else {
        echo json_encode(['success' => true, 'message' => "Produto adicionado ao carrinho!", 'qtd' => $cont]);
    }
} else {
    $cont = count($_SESSION['pedidoscarrinho']);
    echo json_encode(['success' => false, 'message' => "Erro ao adicionar produto!",  'qtd' => $cont]);
}

