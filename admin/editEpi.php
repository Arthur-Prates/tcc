<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idEditEpi']) ? addslashes($dados['idEditEpi']) : '';
    $nome = isset($dados['nomeEpiEdit']) ? addslashes($dados['nomeEpiEdit']) : '';
    $certificado = isset($dados['certificadoEpiEdit']) ? addslashes($dados['certificadoEpiEdit']) : '';
    $quantidade = isset($dados['quantidadeEpiEdit']) ? addslashes($dados['quantidadeEpiEdit']) : '';


    if (isset($_FILES["fotoEpiEdit"]) && $_FILES["fotoEpiEdit"]['error'] === UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES["fotoEpiEdit"]['tmp_name'];
        $fotoName = $_FILES["fotoEpiEdit"]['name'];

        $uploadDir = '../img/produtos';

        $fotoPath = uniqid() . '_' . $fotoName;

        if (move_uploaded_file($fotoTmpName, $uploadDir . '/' . $fotoPath)) {
            $retornoInsert = alterar3Item('epi', 'nomeEpi', 'certificado', 'foto', "$nome", "$certificado", "$fotoPath", 'idepi', "$id");
            if ($quantidade !== '') {
                $verificacao = listarItemExpecifico('*', 'estoque', 'idepi', $id);
                if ($verificacao !== 'Vazio') {
                    foreach ($verificacao as $item) {
                        $qtdTotal = $item->quantidade;
                        $qtdDisponivel = $item->disponivel;

                        if ($qtdTotal == $qtdDisponivel) {
                            $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel', "$quantidade", "$quantidade", 'idepi', "$id");
                        } else {
                            $diferencaQtdTotalANDqtdDisponivel = $qtdTotal - $qtdDisponivel;

                            $novaQtdDisponivel = $quantidade - $diferencaQtdTotalANDqtdDisponivel;


                            $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel',"$quantidade","$novaQtdDisponivel", 'idepi', "$id");
                        }
                    }

                } else {
                    echo json_encode(['success' => false, 'message' => "Epi não consta no estoque!"]);
                }

            } else {
                $retornoUpdate = 0;
            }

            if ($retornoInsert > 0 || $retornoUpdate > 0) {
                echo json_encode(['success' => true, 'message' => "Epi alterado com sucesso"]);
            } else {
                echo json_encode(['success' => false, 'message' => "Epi não alterado!"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Foto não encontrada!"]);
        }

    } else {
        $retornoInsert = alterar2Item('epi', 'nomeEpi', 'certificado', "$nome", "$certificado", 'idepi', "$id");
        if ($quantidade !== '') {
            $verificacao = listarItemExpecifico('*', 'estoque', 'idepi', $id);
            if ($verificacao !== 'Vazio') {
                foreach ($verificacao as $item) {
                    $qtdTotal = $item->quantidade;
                    $qtdDisponivel = $item->disponivel;

                    if ($qtdTotal == $qtdDisponivel) {
                        $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel', "$quantidade", "$quantidade", 'idepi', "$id");
                    } else {
                        $diferencaQtdTotalANDqtdDisponivel = $qtdTotal - $qtdDisponivel;
                        $novaQtdDisponivel = $quantidade - $diferencaQtdTotalANDqtdDisponivel;

                        $retornoUpdate = alterar2Item('estoque', 'quantidade', 'disponivel',"$quantidade","$novaQtdDisponivel", 'idepi', "$id");
                    }
                }
            } else {
                echo json_encode(['success' => false, 'message' => "Epi não consta no estoque!"]);
            }
        } else {
            $retornoUpdate = 0;
        }

        if ($retornoInsert > 0 || $retornoUpdate > 0) {
            echo json_encode(['success' => true, 'message' => "Epi alterado com sucesso"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Epi não alterado!"]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
