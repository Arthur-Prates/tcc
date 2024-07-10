<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $nome = isset($dados['nomeUsuarioAdd']) ? addslashes($dados['nomeUsuarioAdd']) : '';
    $sobrenome = isset($dados['sobrenomeUsuarioAdd']) ? addslashes($dados['sobrenomeUsuarioAdd']) : '';
    $CPF = isset($dados['CPFUsuarioAdd']) ? addslashes($dados['CPFUsuarioAdd']) : '';
    $nascimento = isset($dados['nascimentoUsuarioAdd']) ? addslashes($dados['nascimentoUsuarioAdd']) : '';
    $cargo = isset($dados['cargoUsuarioAdd']) ? addslashes($dados['cargoUsuarioAdd']) : '';
    $email = isset($dados['emailUsuarioAdd']) ? addslashes($dados['emailUsuarioAdd']) : '';
    $senha = isset($dados['senhaUsuarioAdd']) ? addslashes($dados['senhaUsuarioAdd']) : '';
    $senhaCrip = criarSenhaHash("$senha");
    $matricula = random_int(1000000,99999999);

    $retornoInsert = insert9Item('usuario', 'nomeUsuario, sobrenome, cpf, nascimento, matricula, cargo, email, senha, cadastro', "$nome", "$sobrenome", "$CPF", "$nascimento","$matricula","$cargo", "$email", "$senhaCrip", DATATIMEATUAL);
    if ($retornoInsert > 0) {
        echo json_encode(['success' => true, 'message' => "Usuario cadastrado com sucesso"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Usuario não cadastrado!"]);
    }

} else {
    echo json_encode(['success' => false, 'message' => "Erro, nenhum dado encontrado!"]);
}