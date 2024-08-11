<?php

?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Epi(s) danificado(s)</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button class="btn btnAmareloBos" style="float: right"
                    onclick="imprimir('Lista de Epi(s) do Sistema','tabelaEpi')"><i class="bi bi-printer"></i></button>
            <button type="button" class="btn btn-dark" onclick="carregarConteudo('listarReparados')">Ver reparado(s)</button>
        </div>
    </div>
    <div class="overflowTable" id="tabelaEpi">
        <table class="table table-hover table-bordered border-terciary rounded-table tabelaEpi">
            <thead class="table-dark">
            <tr style="height: 50%">
                <th scope="col" style="width: 5%;" class="text-center bg-dark text-white">#</th>
                <th scope="col" style="width: 20%;" class="bg-dark text-white">Código do Empréstimo</th>
                <th scope="col" style="width: 40%;" class="bg-dark text-white">Nome do EPI danificado</th>
                <th scope="col" style="width: 20%;" class="bg-dark text-white">Procedimento necessário</th>
                <th scope="col" style="width: 15%;" class="bg-dark text-white no-print">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaEpiDanificado = listarTabelaInnerJoinTriploOrdenadaExpecifica('a.idepiDanificado,a.idepi, a.codigoDoEmprestimo,a.observacao,a.statusEpi,a.reparado,b.nomeEpi', 'epidanificado', 'epi', 'emprestimo', 'idepi', 'idepi', 'codigoDoEmprestimo', 'codigoEmprestimo', 'reparado','N','statusEpi', 'ASC');

            if ($listaEpiDanificado !== 'Vazio') {
                foreach ($listaEpiDanificado as $item) {
                    $idepi = $item->idepi;
                    $codigoEpi = $item->codigoDoEmprestimo;
                    $observacao = $item->observacao;
                    $statusEpi = $item->statusEpi;
                    $nomeEpi = $item->nomeEpi;
                    $idAvaria = $item->idepiDanificado;
                    $reparado = $item->reparado;

                    if ($statusEpi == 2) {
                        $statusEpiVisualizado = 'Reparar o EPI';
                    } else if ($statusEpi == 3) {
                        $statusEpiVisualizado = 'Substituir o EPI';
                    }

                    if ($observacao == '') {
                        $observacao = 'Nenhuma observação foi realizada!';
                    }

                    ?>
                    <tr class="" id="row-<?php echo $idepi ?>">
                        <th scope="row" class="text-center"><?php echo $contar ?></th>
                        <td class="align-items-center"><?php echo $codigoEpi ?></td>
                        <td class="align-items-center"><?php echo $nomeEpi ?></td>
                        <td class=""><?php echo $statusEpiVisualizado ?></td>
                        <td class="no-print text-center">

                            <?php
                            if ($statusEpi == 2) {
                                ?>
                                <button type="button" class="btn btn-sm btnAzul"
                                        onclick="abrirModalAvariados('<?php echo $idepi ?>','idEpiVermais','<?php echo $codigoEpi ?>','codigoDoEmprestimo','<?php echo $observacao ?>','<?php echo $observacao ?>','observacao','<?php echo $statusEpi ?>','statusDoPedido','modalAvariadosVermais','A','btnFecharModalAvariados','verAvariados','frmVerMais');">
                                    Ver
                                </button>
                                <?php
                                if ($reparado == 'N'){
                                    ?>
                                    <button type="button" class="btn btn-sm btnVerdeBostrap"
                                            onclick="abrirModalAvariados('<?php echo $idAvaria ?>','idEpiEdit','nao','nao','nao','nao','nao','nao','nao','modalAvariadosEdit','A','btnAvariadosEdit','editAvariados','frmEditAvariados');">
                                        Reparado
                                    </button>

                                    <?php
                                }else{
                                    ?>
                                    <button type="button" class="btn btn-sm btnVerdeBostrap" disabled>
                                        Reparado
                                    </button>
                                    <?php
                                }
                                ?>

                                <?php
                            }else{
                                ?>
                                <button type="button" class="btn btn-sm btnAzul w-75"
                                        onclick="abrirModalAvariados('<?php echo $idepi ?>','idEpiVermais','<?php echo $codigoEpi ?>','codigoDoEmprestimo','<?php echo $observacao ?>','<?php echo $observacao ?>','observacao','<?php echo $statusEpi ?>','statusDoPedido','modalAvariadosVermais','A','btnFecharModalAvariados','verAvariados','frmVerMais');">
                                    Ver
                                </button>

                                <?php
                            }
                            ?>
                        </td>

                    </tr>
                    <?php
                    ++$contar;
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">
                        <h4>Nenhum EPI danificado!</h4>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>