<?php

?>
<div class="teste mt-5">
    <button type="button" class="btn btn-dark" style="float: right">Cadastrar</button>
</div>
<table class="table table-hover table-bordered border-dark mt-5">
    <thead class="table-dark">
    <tr>
        <th scope="col" style="width: 10%;">#</th>
        <th scope="col" style="width: 40%;">Epi</th>
        <th scope="col" style="width: 40%;">Certificado</th>
        <th scope="col" style="width: 10%;">Ação</th>
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
            <td colspan="4" class="text-center">
                <h4>Nenhum Usuario cadastrado no banco</h4>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>