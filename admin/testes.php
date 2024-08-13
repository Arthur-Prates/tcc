<?php
include_once("../config/constantes.php");
include_once("../config/conexao.php");
include_once("../func/funcoes.php");

$listaProdutos = listarTabelaInnerJoinQuadruploWhere('f.idepi', 'emprestimo', 'usuario', 'produtoEmprestimo', 'epi', 'idusuario', 'idusuario', 'codigoEmprestimo', 'codEmprestimo', 'idepi', 'idepi', 'd.codEmprestimo', "66ba9cc839d54", 'horaFim', 'DESC');
foreach ($listaProdutos as $item) {
    $idepi = $item->idepi;
    $descartaveis = listarItemExpecifico('*', 'estoque', 'idepi', $idepi);
    if($descartaveis > 0){
     print_r($descartaveis);
        foreach ($descartaveis as $foi) {
            $descartavel = $foi->descartavel;

            if ($descartavel == 'S') {
                $retornoDeletar = deletarCadastro('produtoemprestimo', 'idepi', "$idepi");
            }
        }
    }

}