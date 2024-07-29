<?php

?>
<div class="container">
    <div class="mt-5 d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Epi(s)</h1>
        <div>
            <button class="btn btnAmareloBos mx-1" style="float: right"
                    onclick="imprimir('Lista de Epi(s) do Sistema','tabelaEpi')"><i class="bi bi-printer"></i></button>
            <button type="button" class="btn btnDark mb-3 " style="float: right"
                    onclick="abrirModalEpiAdd('fotoEpiAdd','nao','nao','nao','nao','nao','nao','nao', 'modalEpiAdd','A', 'btnEpiAdd', 'addEpi', 'frmEpiAdd')">
                Cadastrar
            </button>
        </div>
    </div>
    <div class="overflowTable" id="tabelaEpi">
        <table class="table table-hover table-bordered border-terciary rounded-table tabelaEpi">
            <thead class="table-dark">
            <tr style="height: 50%">
                <th scope="col" style="width: 5%;" class="text-center bg-dark text-white">#</th>
                <th scope="col" style="width: 10%;" class="bg-dark text-white">Foto</th>
                <th scope="col" style="width: 48%;" class="bg-dark text-white">Epi</th>
                <th scope="col" style="width: 10%;" class="bg-dark text-white">Qtd. Total</th>
                <th scope="col" style="width: 15%;" class="bg-dark text-white">Certificado</th>
                <th scope="col" style="width: 12%;" class="bg-dark text-white no-print">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaEpi = listarTabelaInnerJoinOrdenada("a.idepi,a.foto,a.nomeEpi,a.certificado,b.quantidade", "epi", 'estoque', 'idepi', 'idepi', 'nomeEpi', 'ASC');
            if ($listaEpi) {
                foreach ($listaEpi as $item) {
                    $idepi = $item->idepi;
                    $foto = $item->foto;
                    $nomeEpi = $item->nomeEpi;
                    $certificado = $item->certificado;
                    $quantidade = $item->quantidade;
                    ?>
                    <tr class="">
                        <th scope="row" class="text-center"><?php echo $contar ?></th>
                        <td class="centraliza">
                            <img src="../img/produtos/<?php echo $foto ?>" width='50' alt=""
                                 class="fotoPerfil  img-fluid fotoEpi ">
                        </td>
                        <td class=" align-items-center "><?php echo $nomeEpi ?></td>
                        <td class=""><?php echo $quantidade ?></td>
                        <td class=""><?php echo $certificado ?></td>
                        <td class="no-print text-center">
                            <button type="button" class="btn btnAzul"
                                    onclick="abrirModalEpiAdd('fotoEpiEdit','<?php echo $foto ?>','<?php echo $idepi ?>','idEditEpi','<?php echo $nomeEpi ?>','nomeEpiEdit','<?php echo $certificado; ?>','certificadoEpiEdit', 'modalEpiEdit','A', 'btnEpiEdit', 'editEpi', 'frmEpiEdit')">
                                <span class="mdi mdi-file-document-edit-outline"></span></button>
                            <button type="button" class="btn btnVermelho"
                                    onclick="deletarEpi('<?php echo $idepi ?>','deleteEpi')"><span
                                        class="mdi mdi-trash-can"></span></button>
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