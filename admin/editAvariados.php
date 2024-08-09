<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idEpiEdit']) ? addslashes($dados['idEpiEdit']) : '';
    $reparado = isset($dados['selectReparado']) ? addslashes($dados['selectReparado']) : '';


    $resultadoUpdate = alterar1Item('epidanificado', 'reparado',$reparado, 'idepiDanificado',$id);

    if ($resultadoUpdate > 0) {
        echo json_encode(['success' => true, 'message' => 'O EPI foi marcado como REPARADO!']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Erro ao marcar como REPARADO!']);
    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}
