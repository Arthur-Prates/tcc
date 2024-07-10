<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
echo json_encode($dados);
//
//{
//    "idUsuarioEdit": "1",
//    "nomeUsuarioEdit": "Ademiro",
//    "sobrenomeUsuarioEdit": "Silva",
//    "CPFUsuarioEdit": "123.658.785-55",
//    "nascimentoUsuarioEdit": "1985-09-21",
//    "cargoUsuarioEdit": "adm",
//    "emailUsuarioEdit": "ademirosilva@gmail.com",
//    "senhaUsuarioEdit": "12345678",
//    "controle": "editUsuario"
//}



if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idUsuarioEdit']) ? addslashes($dados['idUsuarioEdit']) : '';
    $nome = isset($dados['nomeUsuarioEdit']) ? addslashes($dados['nomeUsuarioEdit']) : '';
    $sobrenome = isset($dados['sobrenomeUsuarioEdit']) ? addslashes($dados['sobrenomeUsuarioEdit']) : '';
    $CPF = isset($dados['CPFUsuarioEdit']) ? addslashes($dados['CPFUsuarioEdit']) : '';
    $nascimento = isset($dados['nascimentoUsuarioEdit']) ? addslashes($dados['nascimentoUsuarioEdit']) : '';
    $cargo = isset($dados['cargoUsuarioEdit']) ? addslashes($dados['cargoUsuarioEdit']) : '';
    $email = isset($dados['emailUsuarioEdit']) ? addslashes($dados['emailUsuarioEdit']) : '';
    $senha = isset($dados['senhaUsuarioEdit']) ? addslashes($dados['senhaUsuarioEdit']) : '';


    $senhaCrip = criarSenhaHash("$senha");

    $retornoInsert = alterar7Item('usuario', 'nomeUsuario', 'sobrenome', 'cpf', 'nascimento',  'cargo', 'email', 'senha', "$nome", "$sobrenome", "$CPF", "$nascimento","$cargo", "$email", "$senhaCrip",'idusuario',"$id");
    if ($retornoInsert > 0) {
        echo json_encode(['success' => true, 'message' => "Usuario cadastrado com sucesso"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Usuario não cadastrado!"]);
    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}