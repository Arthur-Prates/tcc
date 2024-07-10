<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

$idFuncionario = $_SESSION['idFuncionario'];

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (isset($dados) && !empty($dados)) {
    $email = isset($dados['inpAlterarEmail']) ? addslashes($dados['inpAlterarEmail']) : '';
    $celular = isset($dados['inpAlterarTelefone']) ? addslashes($dados['inpAlterarTelefone']) : '';

    $updateEmail = false;
    $updateCelular = false;

    if ($email != '') {
        $updateEmail = alterar1Item('usuario', 'email', $email, 'idusuario', $idFuncionario);
        if ($updateEmail) {
            $updateEmail = true;
        }
    }

    if ($celular != '') {
        $tabelaCelular = listarItemExpecifico('*', 'telefone', 'idusuario', $idFuncionario);

        if ($tabelaCelular != 'Vazio') {
            $updateCelular = alterar1Item('telefone', 'numero', $celular, 'idusuario', $idFuncionario);
            if ($updateCelular) {
                $updateCelular = true;
            }
        } else {
            $updateCelular = insert3Item('telefone', 'idusuario, numero, cadastro', $idFuncionario, $celular, DATATIMEATUAL);
            if ($updateCelular) {
                $updateCelular = true;
            }
        }
    }

    if ($updateEmail && $updateCelular) {
        echo json_encode(['success' => true, 'message' => "Dados alterados com sucesso!"]);
    } else if ($updateEmail) {
        echo json_encode(['success' => true, 'message' => "Email alterado com sucesso!"]);
    } else if ($updateCelular) {
        echo json_encode(['success' => true, 'message' => "Celular alterado com sucesso!"]);
    } else {
        echo json_encode(['success' => false, 'message' => "Erro ao alterar dados!"]);
    }
}
