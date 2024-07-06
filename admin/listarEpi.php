<?php

?>
<div class="teste mt-5">
    <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Epi(s)</h1>
    <button type="button" class="btn btn-dark" style="float: right">Cadastrar</button>
</div>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col" style="width: 10%;">#</th>
        <th scope="col" style="width: 40%;">Foto</th>
        <th scope="col" style="width: 40%;">Epi</th>
        <th scope="col" style="width: 10%;">Certificado</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaEpi = listarTabela("*", "epi");
    if ($listaEpi) {
        foreach ($listaEpi as $item) {
            $idepi = $item->idepi;
            $foto = $item->foto;
            $nomeEpi = $item->nomeEpi;
            $certificado = $item->certificado;

//            idepi, nome, certificado, foto, cadastro, alteracao, ativo
            ?>
            <tr class="">
                <th scope="row"><?php echo $contar ?></th>
                <td class="centraliza"><img src="../img/produtos/<?php echo $foto ?>" width='50' alt="" class="fotoEpi">
                </td>
                <td class=" align-items-center "><?php echo $nomeEpi ?></td>
                <td class=""><?php echo $certificado ?></td>
            </tr>
            <?php
            ++$contar;
        }
    } else {
        ?>
        <tr>
            <td colspan="4" class="text-center">
                <h4>Nenhum usuário cadastrado no banco</h4>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>