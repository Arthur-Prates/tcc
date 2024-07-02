<?php

?>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
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
            $nome = $item -> nome;
            $certificado = $item -> certificado;

//            idepi, nome, certificado, foto, cadastro, alteracao, ativo
            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo $nome?></td>
                <td><?php echo $certificado?></td>
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