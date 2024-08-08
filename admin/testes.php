<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");

$tipo= 'disponivel';
$selectDisponivel = listarTabela('sum(disponivel) as totalDisponivel', 'estoque');
$selectQuantidade = listarTabela('sum(quantidade) as totalItems', 'estoque');
$selectiEpiDanificado = listarItemExpecifico('COUNT(idepiDanificado) as Avariados', 'epiDanificado', 'statusEpi','2');
foreach ($selectQuantidade as $itemContar) {
    $quantidade = $itemContar->totalItems;
}
foreach ($selectDisponivel as $itemContar) {
    $disponivel = $itemContar->totalDisponivel;
}
foreach ($selectiEpiDanificado as $itemContar) {
    $avariado = $itemContar->Avariados;
}
$indisponivel = $quantidade - $disponivel + $avariado;
$disponivel = $disponivel - $avariado;
echo $avariado;
if ($tipo == 'disponivel') {
    echo $disponivel;
} else if ($tipo == 'indisponivel') {

    echo $indisponivel;
}
if ($tipo == 'alugado') {
    return "alugado";

} else if ($tipo == 'contar') {

    $arayEpiTable = array();
    $epi = listarTabela('idepi', 'epi');
    foreach ($epi as $epiItems) {
        $alinhar = $epiItems->idepi;
        array_push($arayEpiTable, "$alinhar");

    }

    $arayEpiTable = array_values($arayEpiTable);
    $arayEpiTable = array_unique($arayEpiTable);


    $arayEpiAlugadoTable = array();
    $epiResultado = array();
    $arayEpiAlugadoTable = listarTabela('idepi', 'emprestimo');


    foreach ($arayEpiAlugadoTable as $epiItems2) {
        $alinhar2 = $epiItems2->idepi;
        array_push($epiResultado, "$alinhar2");

    }
    $epiResultado = array_values($epiResultado);
    $epiResultado = array_unique($epiResultado);

    $result = array_diff($arayEpiTable, $epiResultado);
    $result = array_values($result);
    $result = array_unique($result);
    print_r( $result);
}

//idepiDanificado, idepi, codigoDoEmprestimo, observacao, statusEpi, quantidade, cadastro, alteracao, ativo