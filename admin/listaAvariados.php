<?php

?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Epi(s)</h1>
        <div>
            <button class="btn btnAmareloBos mx-1" style="float: right"
                    onclick="imprimir('Lista de Epi(s) do Sistema','tabelaEpi')"><i class="bi bi-printer"></i></button>

        </div>
    </div>
    <div class="overflowTable" id="tabelaEpi">
        <table class="table table-hover table-bordered border-terciary rounded-table tabelaEpi">
            <thead class="table-dark">
            <tr style="height: 50%">
                <th scope="col" style="width: 5%;" class="text-center bg-dark text-white">#</th>
                <th scope="col" style="width: 40%;" class="bg-dark text-white">Código do Empréstimo</th>
                <th scope="col" style="width: 40%;" class="bg-dark text-white">Status</th>
                <th scope="col" style="width: 15%;" class="bg-dark text-white no-print">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaEpiDanificado = listarTabela('*','epidanificado');
            if ($listaEpiDanificado) {
                foreach ($listaEpiDanificado as $item) {
                    $idepi = $item -> idepi;
                    $codigoEpi = $item -> codigoDoEmprestimo;
                    $observacao = $item -> observacao;
                    $statusEpi = $item -> statusEpi;

                    if ($statusEpi == 2){
                        $statusEpi = 'Reparar EPI';
                    }else if ($statusEpi == 3){
                        $statusEpi = 'Substituir EPI';
                    }

                    ?>
                    <tr class="" id="row-<?php echo $idepi?>">
                        <th scope="row" class="text-center"><?php echo $contar ?></th>
                        <td class="align-items-center"><?php echo $codigoEpi ?></td>
                        <td class=""><?php echo $statusEpi ?></td>
                        <td class="no-print">
                            <button type="button" class="btn btn-sm btnAzul"
                                    onclick="abrirModalAvariados('<?php echo $idepi?>', 'idEpiVermais', '<?php echo $codigoEpi?>', 'codigoDoEmprestimo', '<?php echo $observacao?>', 'observacao', '<?php echo $statusEpi?>', 'statusDoPedido', 'modalUsuarioVermais', 'A', 'btnFecharModalAvariados', '', 'frmAvariadosVermais')">
                                Ver
                            </button>
                            <button type="button" class="btn btn-sm btn-success"
                                    onclick="">
                                Reparado
                            </button>
                        </td>

                    </tr>
                    <?php
                    ++$contar;
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" class="text-center">
                        <h4>Nenhum EPI cadastrado no banco</h4>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>