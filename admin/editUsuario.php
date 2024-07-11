<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


if (isset($dados) && !empty($dados)) {
    $id = isset($dados['idUsuarioEdit']) ? addslashes($dados['idUsuarioEdit']) : '';
    $nome = isset($dados['nomeUsuarioEdit']) ? addslashes($dados['nomeUsuarioEdit']) : '';
    $sobrenome = isset($dados['sobrenomeUsuarioEdit']) ? addslashes($dados['sobrenomeUsuarioEdit']) : '';
    $CPF = isset($dados['CPFUsuarioEdit']) ? addslashes($dados['CPFUsuarioEdit']) : '';
    $nascimento = isset($dados['nascimentoUsuarioEdit']) ? addslashes($dados['nascimentoUsuarioEdit']) : '';
    $cargo = isset($dados['cargoUsuarioEdit']) ? addslashes($dados['cargoUsuarioEdit']) : '';
    $email = isset($dados['emailUsuarioEdit']) ? addslashes($dados['emailUsuarioEdit']) : '';
    $senha = isset($dados['novaSenhaUsuarioEdit']) ? addslashes($dados['novaSenhaUsuarioEdit']) : '';

    if ($senha == ''){
        $retornoUpdate = alterar6Item('usuario', 'nomeUsuario', 'sobrenome', 'cpf', 'nascimento',  'cargo', 'email', "$nome", "$sobrenome", "$CPF", "$nascimento","$cargo", "$email",'idusuario',"$id");
    }else{
        $senhaCrip = criarSenhaHash("12345678");
        $retornoUpdate = alterar7Item('usuario', 'nomeUsuario', 'sobrenome', 'cpf', 'nascimento',  'cargo', 'email', 'senha', "$nome", "$sobrenome", "$CPF", "$nascimento","$cargo", "$email", "$senhaCrip",'idusuario',"$id");
    }

    if ($retornoUpdate > 0) {
        echo json_encode(['success' => true, 'message' => "Usuario alterado com sucesso"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Usuario não alterado!"]);
    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}