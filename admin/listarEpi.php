<?php

?>
<h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Epi(s)</h1>
<table class="table table-hover table-bordered border-dark">
    <thead class="table-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Foto</th>
        <th scope="col">Epi</th>
        <th scope="col">Certificado</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaEpi = listarTabela("*", "epi");
    if ($listaEpi) {
        foreach ($listaEpi as $item) {
            $idepi = $item -> idepi;
            $foto = $item -> foto;
            $nomeEpi = $item -> nomeEpi;
            $certificado = $item -> certificado;

//            idepi, nome, certificado, foto, cadastro, alteracao, ativo
            ?>
            <tr class="">
                <th scope="row" ><?php echo $contar?></th>
                <td class="centraliza"><img src="../img/produtos/<?php echo $foto?>" width='50' alt="" class="fotoEpi"></td>
                <td class=" align-items-center "><?php echo $nomeEpi?></td>
                <td class=""><?php echo $certificado?></td>
            </tr>
            <?php
            ++$contar;
        }
    } else {
        ?>
        <tr>
            <td colspan="4" class="text-center">
                <h4>Nenhum Usuario cadastrado no banco</h4>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>