<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);

if (isset($dados) && !empty($dados)) {
    $senha = isset($dados['inpAlterarSenha']) ? addslashes($dados['inpAlterarSenha']) : '';
    $confirmacaoSenha = isset($dados['confirmarAlteracaoDaSenha']) ? addslashes($dados['confirmarAlteracaoDaSenha']) : '';


    if ($senha != $confirmacaoSenha){
        echo json_encode(['success' => false, 'message' => 'As senhas não se coincidem!']);
    }else{
        $senhaHash = criarSenhaHash($senha);
        $retornoupdate = alterar1Item('usuario','senha',$senhaHash,'idusuario',"$idFuncionario");
        if ($retornoupdate > 0) {
            echo json_encode(['success' => true, 'message' => "Senha alterada com sucesso!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Erro ao alterar a senha!"]);
        }
    }

}