<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');

$TOTALFIMEND = array();
$aray = array();
$topTotal = array();
$arayPessoas = array();
$contarAray = 0;

$selectAlugadores = listarTabelaInnerJoinOrdenadaLimitada('a.idusuario,a.nomeUsuario,a.sobrenome, b.idusuario as idUser', 'usuario', 'emprestimo', 'idusuario', 'idusuario', 'idUser', 'ASC');

foreach ($selectAlugadores as $itemAlu) {
    $iduser = $itemAlu->idusuario;
    $nomeUser = $itemAlu->nomeUsuario;
    $sobrenomeUser = $itemAlu->sobrenome;
    $pessoa = "$nomeUser $sobrenomeUser";
    array_push($aray, "$iduser");
    array_push($arayPessoas, "$pessoa");
}

$aray = array_unique($aray);
$aray = array_values($aray);
$arayPessoas = array_unique($arayPessoas);
$arayPessoas = array_values($arayPessoas);
foreach ($aray as $itemArray) {
    $id = $itemArray;

    $selectTopAluguel = listarTabelaInnerJoinTriploOrdenadaExpecifica2Where('sum(quantidade) as total', 'emprestimo', 'usuario', 'produtoemprestimo', 'idusuario', 'idusuario', 'codigoEmprestimo', 'codEmprestimo', 'a.idusuario', "$id", 'd.devolucao', 'N', 'total', 'ASC');

    foreach ($selectTopAluguel as $valor) {
        $fim = $valor->total;

    }
    array_push($topTotal, "$fim");


    $topTotal = array_values($topTotal);
    $contarAray = $contarAray + 1;


}
    $TOTALFIMEND = array_combine($arayPessoas, $topTotal);
    arsort($TOTALFIMEND);
echo '<pre>';

print_r($TOTALFIMEND);
print_r($arayPessoas);
print_r($aray);
echo '</pre>';
