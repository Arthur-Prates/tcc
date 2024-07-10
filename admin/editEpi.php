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


    if (isset($_FILES["fotoEpiEdit"]) && $_FILES["fotoEpiEdit"]['error'] === UPLOAD_ERR_OK) {
        $fotoTmpName = $_FILES["fotoEpiEdit"]['tmp_name'];
        $fotoName = $_FILES["fotoEpiEdit"]['name'];

        $uploadDir = '../img/produtos';

        $fotoPath = uniqid() . '_' . $fotoName;

        if (move_uploaded_file($fotoTmpName, $uploadDir . '/' . $fotoPath)) {
            $retornoInsert = alterar3Item('epi', 'nomeEpi', 'certificado', 'foto', "$nome", "$certificado", "$fotoPath", 'idepi',"$id");
            if ($retornoInsert > 0) {
                echo json_encode(['success' => true, 'message' => "Epi alterado com sucesso"]);
            } else {
                echo json_encode(['success' => false, 'message' => "Epi não alterado!"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Foto não encontrada!"]);
        }

    }
} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
