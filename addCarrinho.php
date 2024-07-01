<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$dados = filter_input(INPUT_POST, 'idepi', FILTER_SANITIZE_NUMBER_INT);
//echo json_encode($dados);

if (!isset($_SESSION['pedidoscarrinho'])) {
    $_SESSION['pedidoscarrinho'] = array();
}

$produto = listarItemExpecifico('*', 'epi', 'idepi', $dados);
if ($produto !== 'vazio') {
    foreach ($produto as $item) {
        $id = $item->idepi;
        $nomeEpi = $item->nome;
        $foto = $item->foto;
        $codigo = $item->certificado;

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
        $carrinho = $_SESSION['pedidoscarrinho'];
        $qtd = $carrinho['quantidade'];
        if ($qtd == $dados) {
            $carrinho['quantidade'] = $carrinho['quantidade'] + 1;
       }

    }
    echo json_encode(['success' => true, 'message' => "Produto adicionado ao carrinho!"]);
}


