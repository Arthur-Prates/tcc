<?php

?>
<div class="teste mt-5">
    <button type="button" class="btn btn-dark" style="float: right">Cadastrar</button>
</div>
<table class="table table-hover table-bordered border-dark mt-5">
    <thead class="table-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Usuario</th>
        <th scope="col">Epi</th>
        <th scope="col">Cod Aluguel</th>
        <th scope="col">Ação</th>
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
                <th scope="row"><?php echo $contar ?></th>
                <td><?php echo $idusuario ?></td>
                <td><?php echo $idepi ?></td>
                <td><?php echo $codigoAluguel ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i></button>
                        <button type="button" class="btn btn-outline-success"><i class="bi bi-pen"></i></button>
                        <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>
            <?php
            ++$contar;
        }
    } else {
        ?>
        <tr>
            <td colspan="5" class="text-center">
                <h4>Nenhum Aluguel cadastrado no banco</h4>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>