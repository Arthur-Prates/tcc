<?php
?>

<?php

?>
<div class="container">
    <div class="mt-5 d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Estoque dos EPI(s)</h1>
        <button class="btn btn-outline-warning text-black mx-1"  style="float: right" onclick="imprimir('Lista de Empréstimo(s) do Sistema','tabelaEmprestimo')"><i class="bi bi-printer"></i></button>
    </div>

    <div class="overflowTable" id="tabelaEmprestimo">
        <table class="table table-hover table-bordered border-dark text-center rounded-table">
            <thead class="table-dark">
            <tr>
                <th scope="col" width="5%">#</th>
                <th scope="col" width="45%">Nome EPI</th>
                <th scope="col" width="10%">N° CA</th>
                <th scope="col" width="10%">Qtd. total</th>
                <th scope="col" width="15%">Qtd. disponível</th>
                <th scope="col" width="15%" class="no-print">Ações</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listarEstoque = listarTabelaInnerJoinOrdenada('*','estoque','epi','idepi','idepi','a.idepi','ASC');
            if ($listarEstoque) {
                foreach ($listarEstoque as $itemEstoque) {
                    $idEpi = $itemEstoque -> idepi;
                    $nomeEpi = $itemEstoque -> nomeEpi;
                    $quantidadeTotal = $itemEstoque -> quantidade;
                    $quantidadeDisponivel = $itemEstoque -> disponivel;
                    $foto = $itemEstoque -> foto;
                    $certificado = $itemEstoque -> certificado;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $contar ?></th>
                        <td><?php echo $nomeEpi ?></td>
                        <td><?php echo $certificado ?></td>
                        <td>
                            <?php echo $quantidadeTotal ?>
                        </td>
                        <td class="">
                            <?php echo $quantidadeDisponivel ?>
                        </td>
                        <td class="no-print">

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
