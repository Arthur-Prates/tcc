<?php
include_once("../config/conexao.php");
include_once("../config/constantes.php");
include_once("../func/funcoes.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//echo json_encode($dados);


$busca = $dados['buscarUsuario'];

$resultadoPesquisaUser = pesquisaLikeDuplo('idusuario,nomeUsuario,sobrenome,numero,cpf,nascimento,matricula,cargo,email', 'usuario', 'nomeUsuario', 'sobrenome', $busca, $busca);
$resultadoPesquisaEPI = pesquisaLike('idepi,nomeEpi,certificado', 'epi', 'nomeEpi', $busca);

unset($_SESSION['resultadoPesquisaUser']);
unset($_SESSION['resultadoPesquisaEpi']);

if ($resultadoPesquisaUser !== 'Vazio') {
    foreach ($resultadoPesquisaUser as $resultado) {
        $idUsuario = $resultado->idusuario;
        $nomeUsuario = $resultado->nomeUsuario;
        $sobrenome = $resultado->sobrenome;
        $numero = $resultado->numero;
        $cpf = $resultado->cpf;
        $nascimento = $resultado->nascimento;
        $matricula = $resultado->matricula;
        $cargo = $resultado->cargo;
        $email = $resultado->email;

        $_SESSION['resultadoPesquisaUser'][] = [
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

//    print_r($_SESSION['resultadoPesquisaUser']);
    $pesquisaUser = 'Resultados encontrados';
} else {
    $pesquisaUser = 'Vazio';
}


if ($resultadoPesquisaEPI !== 'Vazio') {
    foreach ($resultadoPesquisaEPI as $resultado) {
        $idEpi = $resultado->idepi;
        $nomeEpi = $resultado->nomeEpi;
        $certificado = $resultado->certificado;

        $_SESSION['resultadoPesquisaEpi'][] = [
            'idEpi' => $idEpi,
            'nomeEpi' => $nomeEpi,
            'certificado' => $certificado,
        ];
    }

    $pesquisaEpi = 'Resultados encontrados';
} else {
    $pesquisaEpi = 'Vazio';
}

if ($pesquisaEpi !== 'Vazio' || $pesquisaUser !== 'Vazio') {
    echo json_encode(['success' => true, 'message' => 'Busca realizada com sucesso!']);
}else{
    echo json_encode(['success' => false, 'message' => 'Nenhum resultado encontrado!']);
}
