<?php

?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Empréstimo(s) Devolvidos</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button"  class="btn btnAmareloBos"  style="float: right" onclick="imprimir('Lista de empréstimo(s) do Sistema','tabelaEmprestimo')"><i class="bi bi-printer"></i></button>
            <button type="button" class="btn btn-dark" onclick="carregarConteudo('listarAluguel')">Ver Ativos</button>
        </div>
    </div>

    <div class="overflowTable" id="tabelaEmprestimo">
        <table class="table table-hover table-bordered border-dark text-center rounded-table">
            <thead class="table-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col">Locatário</th>
                <th scope="col">Código do empréstimo</th>
                <th scope="col">Prioridade</th>
                <th scope="col" width="10%">Status</th>
                <th scope="col" width="10%" class="no-print">Ações</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaEmprestimo = listarTabelaInnerJoinOrdenadaDuplo('*','emprestimo','usuario','idusuario','idusuario','prioridade', 'DESC','a.devolvido','ASC');
            if ($listaEmprestimo) {
                foreach ($listaEmprestimo as $itemEmprestimo) {
                    $idemprestimo = $itemEmprestimo->idemprestimo;
                    $idusuario = $itemEmprestimo->idusuario;
                    $nomeUsuario = $itemEmprestimo->nomeUsuario;
                    $sobrenome = $itemEmprestimo->sobrenome;
                    $codigoEmprestimo = $itemEmprestimo->codigoEmprestimo;
                    $statusEmprestimo = $itemEmprestimo->devolvido;
                    $prioridade = $itemEmprestimo-> prioridade;
                    $cadastro = $itemEmprestimo-> cadastro;
                    if ($prioridade == '3'){
                        $prioridadeVisivel = 'Alta';
                    }else if ($prioridade == '2'){
                        $prioridadeVisivel = 'Média';
                    }else{
                        $prioridadeVisivel = 'Baixa';
                    }
                    if($statusEmprestimo == 'S'){


                        ?>
                        <tr>
                            <th scope="row"><?php echo $contar ?></th>
                            <td><?php echo "$nomeUsuario $sobrenome" ?></td>
                            <td><?php echo $codigoEmprestimo ?></td>
                            <td><?php echo $prioridadeVisivel ?></td>
                            <td><?php

                                if ($statusEmprestimo == 'S') {
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
                            <td class="no-print">
                                <a href="verificarAluguel.php?emprestimo=<?php echo $codigoEmprestimo ?>"
                                   class="btn btn-sm btn-success">Visualizar</a>
                            </td>
                        </tr>
                        <?php
                        ++$contar;
                    }    }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">
                        <h4>Nenhum Emprestimo cadastrado no banco</h4>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
