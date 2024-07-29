<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$a = print_r($dados, true);
//echo json_encode(['success' => false, 'message' => $a]);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idDelete']) ? addslashes($dados['idDelete']) : '';




    $verificarVazio = listarItemExpecifico('*', 'estoque', 'idepi', "$id");
    if ($verificarVazio !== 'Vazio') {
        foreach ($verificarVazio as $item) {
            $quantidade = $item->quantidade;
            $disponivel = $item->disponivel;

            if ($quantidade > $disponivel) {
                echo json_encode(['success' => false, 'message' => "Epi em Uso"]);
            } else {
                $verificarEmprestimoPendente = listarTabelaInnerJoinOrdenadaDuploWhere('a.idepi,b.devolvido','produtoemprestimo','emprestimo','codEmprestimo','codigoEmprestimo','a.idepi', $id,'devolvido','N','a.idepi','ASC');
                if ($verificarEmprestimoPendente !== 'Vazio'){
                    foreach ($verificarEmprestimoPendente as $emprestimo) {
                        $idTeste = $emprestimo -> idepi;
                        $devolucao = $emprestimo -> devolvido;

                        if ($idTeste == $id && $devolucao == 'N'){
                            echo json_encode(['success' => false, 'message' => "Este EPI consta em um empréstimo não concluído!"]);
                            return;
                        }else{
                            $retornoDelete = deletarCadastro('epi', 'idepi', "$id");
                            if ($retornoDelete) {
                                echo json_encode(['success' => true, 'message' => "Epi deletado com sucesso"]);
                            } else {
                                echo json_encode(['success' => false, 'message' => "Epi não deletado!"]);
                            }
                        }


                    }
                }

            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Este EPI não consta no estoque!"]);

    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}