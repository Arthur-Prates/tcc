<?php

?>
<h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Aluguel(éis)</h1>
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
    $listaAluguel = executaQuery("SELECT * FROM aluguel a INNER JOIN usuario u ON a.idusuario = u.idusuario INNER JOIN produtoAluguel pa ON a.codigoAluguel = pa.codAluguel INNER JOIN epi e ON e.idepi = pa.idepi");
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