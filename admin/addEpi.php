<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $nome = isset($dados['nomeEpiAdd']) ? addslashes($dados['nomeEpiAdd']) : '';
    $certificado = isset($dados['certificadoEpiAdd']) ? addslashes($dados['certificadoEpiAdd']) : '';


    if (isset($_FILES["fotoEpiAdd"]) && $_FILES["fotoEpiAdd"]['error'] === UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES["fotoEpiAdd"]['tmp_name'];
        $fotoName = $_FILES["fotoEpiAdd"]['name'];

            $uploadDir = '../img/produtos';

        $fotoPath = uniqid() . '_' . $fotoName;

        if (move_uploaded_file($fotoTmpName, $uploadDir . '/' . $fotoPath)) {
            $retornoInsert = insert4Item('epi', 'nomeEpi, certificado, foto, cadastro', "$nome", "$certificado", "$fotoPath", DATATIMEATUAL);
            if ($retornoInsert > 0) {
                echo json_encode(['success' => true, 'message' => "Epi cadastrado com sucesso"]);
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
