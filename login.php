<?php
include_once("./config/conexao.php");
include_once("./config/constantes.php");
include_once("./func/funcoes.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
// echo json_encode($dados);

$email = $dados['email'];
$senha = $dados['senha'];
$retornoValidar = verificarSenhaCriptografada('*', 'usuario', 'email', $email, 'senha', $senha, 'ativo', 'A');

if ($retornoValidar) {
    if ($retornoValidar == 'usuario') {
        echo json_encode(['success' => false, 'message' => 'Úsuario invalido']);
    } else if ($retornoValidar == 'senha') {
        echo json_encode(['success' => false, 'message' => 'Senha invalida!']);
    } else {
        $_SESSION['idFuncionario'] = $retornoValidar->idusuario;
        $_SESSION['nome'] = $retornoValidar->nomeUsuario;
        $_SESSION['emailAdm'] = $retornoValidar->email;
        echo json_encode(['success' => true, 'message' => "Logado com sucesso!"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Usuario e Senha invalidos!']);
}
