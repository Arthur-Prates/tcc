<?php
include_once("../config/conexao.php");
include_once("../config/constantes.php");
include_once("../func/funcoes.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


$busca = $dados['buscarUsuario'];

$resultadoPesquisa = pesquisaLike('*', 'usuario', 'nomeUsuario', $busca);

unset($_SESSION['resultadoPesquisa']);

if ($resultadoPesquisa !== 'Vazio') {
    foreach ($resultadoPesquisa as $resultado) {
        $idUsuario = $resultado->idusuario;
        $nomeUsuario = $resultado->nomeUsuario;
        $sobrenome = $resultado->sobrenome;
        $numero = $resultado->numero;
        $cpf = $resultado->cpf;
        $nascimento = $resultado->nascimento;
        $matricula = $resultado->matricula;
        $cargo = $resultado->cargo;
        $email = $resultado->email;

        $_SESSION['resultadoPesquisa'][] = [
            'idUsuario' => $idUsuario,
            'nomeUsuario' => $nomeUsuario,
            'sobrenome' => $sobrenome,
            'numero' => $numero,
            'cpf' => $cpf,
            'nascimento' => $nascimento,
            'matricula' => $matricula,
            'cargo' => $cargo,
            'email' => $email,
        ];

    }

//    print_r($_SESSION['resultadoPesquisa']);

    echo json_encode(['success' => true, 'message' => 'Busca realizada com sucesso!']);

} else {
    echo json_encode(['success' => false, 'message' => 'Nenhum resultado encontrado!']);
}
