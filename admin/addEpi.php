<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $nome = isset($dados['nomeEpiAdd']) ? addslashes($dados['nomeEpiAdd']) : '';
    $certificado = isset($dados['certificadoEpiAdd']) ? addslashes($dados['certificadoEpiAdd']) : '';
    $quantidade = isset($dados['quantidadeEpiAdd']) ? addslashes($dados['quantidadeEpiAdd']) : '';
    $descartavel = isset($dados['selectDescartavel']) ? addslashes($dados['selectDescartavel']) : 'N';

    if (isset($_FILES["fotoEpiAdd"]) && $_FILES["fotoEpiAdd"]['error'] === UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES["fotoEpiAdd"]['tmp_name'];
        $fotoName = $_FILES["fotoEpiAdd"]['name'];

            $uploadDir = '../img/produtos';

        $fotoPath = uniqid() . '_' . $fotoName;

        if (move_uploaded_file($fotoTmpName, $uploadDir . '/' . $fotoPath)) {

            $retornoInsert = insert4Item('epi', 'nomeEpi, certificado, foto, cadastro', "$nome", "$certificado", "$fotoPath", DATATIMEATUAL);

            $teste = listarTabelaOrdenadaLimite('*','epi','idepi','DESC',1);
            foreach ($teste as $row) {
                $idepi = $row->idepi;
            }
            $insertNoEstoque = insert5Item('estoque','idepi, quantidade, disponivel,descartavel, cadastro',"$idepi","$quantidade","$quantidade",$descartavel,DATATIMEATUAL);

            if ($retornoInsert > 0) {
                $listarEpi = listarTabelaOrdenadaLimite('idepi','epi','idepi','DESC',1);
                foreach ($listarEpi as $item) {
                    $idepi = $item->idepi;
                }
                echo json_encode(['success' => true, 'message' => "Epi cadastrado com sucesso", 'idEpi' => $idepi]);
            } else {
                echo json_encode(['success' => false, 'message' => "Epi não cadastrado!"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Foto não encontrada!"]);
        }

    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
