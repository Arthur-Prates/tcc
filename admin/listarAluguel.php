<?php

?>
<h1>Aluguel(éis)</h1>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Alugante</th>
        <th scope="col">Epi</th>
        <th scope="col">Cod Aluguel</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaAluguel = listarTabelaInnerJoinTriploOrdenada("*", "aluguel",'epi','usuario','idepi','idepi','idusuario','idusuario','dataFim','ASC');
    if ($listaAluguel) {
        foreach ($listaAluguel as $itemAluguel) {
            $idaluguel = $itemAluguel->idaluguel;
            $idusuario = $itemAluguel->idusuario;
            $nomeUsuario = $itemAluguel->nomeUsuario;
            $nomeEpi = $itemAluguel->nomeEpi;
            $idepi = $itemAluguel->idepi;
            $codigoAluguel = $itemAluguel->codigoAluguel;

            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo $nomeUsuario?></td>
                <td><?php echo $nomeEpi?></td>
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