<?php

include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);
//$testesss = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$produtoremove = false;
$produto = listarItemExpecifico('*', 'epi', 'idepi', $dados);
if ($produto !== 'vazio') {
    foreach ($produto as $item) {
        $id = $item->idepi;
        $nomeEpi = $item->nomeEpi;
        $foto = $item->foto;
        $codigo = $item->certificado;

        foreach ($_SESSION['pedidoscarrinho'] as &$produtoCarrinho) {
            if ($produtoCarrinho['idproduto'] == $id && $produtoCarrinho['quantidade'] > 1) {
                $produtoCarrinho['quantidade'] -= 1;
                $_SESSION['pedidoscarrinho'] = array_values($_SESSION['pedidoscarrinho']);
                $produtoremove = true;
                break;
            }
        }

    }
    $cont = count($_SESSION['pedidoscarrinho']);
    if ($produtoremove) {
        echo json_encode(['success' => true, 'message' => "Quantidade do produto diminuída!", 'qtd' => $cont]);
    }else{
        echo json_encode(['success' => false, 'message' => "Para remover do carrinho clique em 'remover'", 'qtd' => $cont]);
    }
} else {
    $cont = count($_SESSION['pedidoscarrinho']);
    echo json_encode(['success' => false, 'message' => "Erro ao remover produto!", 'qtd' => $cont]);
}

