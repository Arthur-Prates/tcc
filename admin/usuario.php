<?php

?>
<table class="table table-hover table-bordered border-dark mt-5">
    <thead>
    <tr>
        <th scope="col" style="width: 10%">#</th>
        <th scope="col" style="width: 40%">Nome</th>
        <th scope="col" style="width: 40%">Sobrenome</th>
        <th scope="col" style="width: 10%">Ação</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaUsuario = listarTabela("*", "usuario");
    if ($listaUsuario) {
        foreach ($listaUsuario as $item) {
            $idusuario = $item -> idusuario;
            $nome = $item -> nome;
            $sobrenome = $item -> sobrenome;
            $cpf = $item -> cpf;
//            idusuario, nome, sobrenome, cpf, nascimento, matricula, cargo, email, senha, cadastro, alteracao, ativo
            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo $nome?></td>
                <td><?php echo $sobrenome?></td>
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