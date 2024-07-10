<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');


$selectTopAluguel = listarTabelaInnerJoinTriploOrdenadaExpecifica2Where('sum(quantidade) as total', 'aluguel', 'usuario', 'produtoAluguel', 'idusuario', 'idusuario', 'codigoAluguel', 'codAluguel', 'a.idusuario', "2",'d.devolucao','N' ,'total', 'ASC');
foreach ($selectTopAluguel as $valor) {
    $fim = $valor->total;
echo $fim;
}
print_r($selectTopAluguel);