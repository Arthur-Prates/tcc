<?php

include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
$fila = filter_input(INPUT_POST, 'num', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);
//$testesss = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$produtoremove = false;
$produto = listarItemExpecifico('*', 'epi', 'idepi', $dados);
if ($produto !== 'vazio') {
    foreach ($produto as $item) {
        $id = $item->idepi;
        $nomeEpi = $item->nome;
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
    if ($produtoremove) {
        echo json_encode(['success' => true, 'message' => "Quantidade do produto diminuída!"]);
    } else {

        unset($_SESSION['pedidoscarrinho'][$fila]);


        $_SESSION['pedidoscarrinho'] = array_values($_SESSION['pedidoscarrinho']);
        echo json_encode(['success' => false, 'message' => "Produto retirado do carrinho "]);
//        echo json_encode(['success' => false, 'message' => "Produto retirado do carrinho", 'indice' => $indiceEncontrado ]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro ao remover produto!"]);
}

