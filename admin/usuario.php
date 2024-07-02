<?php

?>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Usuario</th>
        <th scope="col">Epi</th>
        <th scope="col">Cod Aluguel</th>
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
                <td><?php echo $idusuario?></td>
                <td><?php echo $nome?></td>
                <td><?php echo $sobrenome?></td>
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