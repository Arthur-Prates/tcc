<?php

?>
<div class="container">

    <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Aluguel(éis)</h1>
    <div class="overflowTable">
        <table class="table table-hover table-bordered border-dark text-center">
            <thead>
            <tr >
                <th scope="col" width="5%">#</th>
                <th scope="col">Locatário</th>
                <th scope="col">Código do empréstimo</th>
                <th scope="col" width="10%">Status</th>
                <th scope="col" width="10%" >Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaAluguel = executaQuery("SELECT * FROM aluguel a INNER JOIN usuario u ON a.idusuario = u.idusuario ORDER BY a.idaluguel DESC ");
            if ($listaAluguel) {
                foreach ($listaAluguel as $itemAluguel) {
                    $idaluguel = $itemAluguel->idaluguel;
                    $idusuario = $itemAluguel->idusuario;
                    $nomeUsuario = $itemAluguel->nomeUsuario;
                    $sobrenome = $itemAluguel->sobrenome;
                    $codigoAluguel = $itemAluguel->codigoAluguel;
                    $statusAluguel = $itemAluguel->devolvido;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $contar ?></th>
                        <td><?php echo"$nomeUsuario $sobrenome"?></td>
                        <td><?php echo $codigoAluguel ?></td>
                        <td><?php

                            if ($statusAluguel == 'S') {
                                $statusEmprestimo = 'Devolvido';
                                $bg = 'text-danger';
                            } else {
                                $statusEmprestimo = 'Ativo';
                                $bg = 'text-success';
                            }
                            echo $statusEmprestimo;
                            ?>
                            <span class="mdi mdi-circle <?php echo $bg ?>"></span>
                            <?php
                            ?></td>
                        <td>
                            <a href="verificarAluguel.php?emprestimo=<?php echo $codigoAluguel ?>"
                               class="btn btn-sm btn-success">Visualizar</a>
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
    </div>
</div>
