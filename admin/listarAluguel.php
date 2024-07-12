<?php

?>
<h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Aluguel(éis)</h1>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Locatário</th>
        <th scope="col">Código do empréstimo</th>
        <th scope="col">Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaAluguel = executaQuery("SELECT * FROM aluguel a INNER JOIN usuario u ON a.idusuario = u.idusuario");
    if ($listaAluguel) {
        foreach ($listaAluguel as $itemAluguel) {
            $idaluguel = $itemAluguel->idaluguel;
            $idusuario = $itemAluguel->idusuario;
            $nomeUsuario = $itemAluguel->nomeUsuario;


            $codigoAluguel = $itemAluguel->codigoAluguel;
            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo $nomeUsuario?></td>
                <td><?php echo $codigoAluguel?></td>
                <td>
                    <a href="verificarAluguel.php?emprestimo=<?php echo $codigoAluguel?>" class="btn btn-sm btn-success">Visualizar</a>
                </td>
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