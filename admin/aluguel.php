<?php

?>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Usuario</th>
        <th scope="col">Epi</th>
        <th scope="col">Cod Aluguel</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaAluguel = listarTabela("*", "aluguel");
    if ($listaAluguel) {
        foreach ($listaAluguel as $itemAluguel) {
            $idaluguel = $itemAluguel->idaluguel;
            $idusuario = $itemAluguel->idusuario;
            $idepi = $itemAluguel->idepi;
            $codigoAluguel = $itemAluguel->codigoAluguel;
//            idaluguel, idusuario, idepi, dataInicio, dataFim, codigoAluguel, prioridade, observacao, cadastro, alteracao, ativo
            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo $idusuario?></td>
                <td><?php echo $idepi?></td>
                <td><?php echo $codigoAluguel?></td>
            </tr>
            <?php
            ++$contar;
        }
    } else {
        ?>
        <tr>
            <td colspan="4" class="text-center">
                <h4>Nenhum Aluguel cadastrado no banco</h4>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>