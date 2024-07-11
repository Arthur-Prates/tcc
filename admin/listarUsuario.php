<?php

?>
<div class="teste mt-5">

    <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Usuário(s)</h1>
    <button type="button" class="btn btn-dark" style="float: right"
            onclick="abrirModalUsuario('nao','nao','nao','nao', 'nao','nao','nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'modalUsuarioAdd', 'A', 'btnUsuarioAdd', 'addUsuario', 'frmUsuarioAdd')">
        Cadastrar
    </button>

</div>

<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>

        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">CPF</th>
        <th scope="col">Cargo</th>
        <th scope="col">Email</th>
        <th scope="col">Ação</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaUsuario = listarTabelaLeftJoinOrdenada("*", "usuario", 'telefone', 'idusuario', 'idusuario', 'nomeUsuario', 'ASC');
    if ($listaUsuario) {
        foreach ($listaUsuario as $item) {
            $idusuario = $item->idusuario;
            $nome = $item->nomeUsuario;
            $sobrenome = $item->sobrenome;
            $telefone = $item->numero;
            $nascimento = $item->nascimento;
            $cpf = $item->cpf;
            $cargo = $item->cargo;
            if ($cargo == 'adm') {
                $cargo = "Adminstrador";
            } else if ($cargo == 'funcionario') {
                $cargo = 'Funcionário';
            } else if ($cargo = 'rh') {
                $cargo = "Recursos Humanos";
            } else if ($cargo == 'almoxarife') {
                $cargo = "Almoxarife";
            } else {
                $cargo = 'Sem cargo';
            }
            $email = $item->email;
            if ($telefone == '') {
                $telefone = 'Sem telefone';
            }
            ?>
            <tr>
                <th scope="row"><?php echo $contar ?></th>
                <td><?php echo "$nome $sobrenome" ?></td>
                <td><?php echo $cpf ?></td>
                <td><?php echo $cargo ?></td>
                <td><?php echo $email ?></td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-success" style="float: right"
                                onclick="abrirModalUsuario('nao','nao','nomeUsuarioVermais','<?php echo $nome; ?>', 'sobrenomeUsuarioVermais','<?php echo $sobrenome; ?>','telefoneUsuarioVermais','<?php echo $telefone ?>', 'CPFUsuarioVermais','<?php echo $cpf; ?>', 'nascimentoUsuarioVermais','<?php echo $nascimento; ?>', 'cargoUsuarioVermais','<?php echo $cargo; ?>', 'emailUsuarioVermais','<?php echo $email; ?>', 'nao','nao','modalUsuarioVermais', 'A', 'nao', 'editUsuario', 'frmUsuarioVermais')">
                            <i class="bi bi-person-lines-fill"></i></button>
                        <button type="button" class="btn btn-info" style="float: right"
                                onclick="abrirModalUsuario('idUsuarioEdit','<?php echo $idusuario; ?>','nomeUsuarioEdit','<?php echo $nome; ?>', 'sobrenomeUsuarioEdit','<?php echo $sobrenome; ?>','telefoneUsuarioEdit','<?php echo $telefone ?>', 'CPFUsuarioEdit','<?php echo $cpf; ?>', 'nascimentoUsuarioEdit','<?php echo $nascimento; ?>', 'cargoUsuarioEdit','<?php echo $cargo; ?>', 'emailUsuarioEdit','<?php echo $email; ?>', 'nao','nao','modalUsuarioEdit', 'A', 'btnUsuarioEdit', 'editUsuario', 'frmUsuarioEdit')">
                            <i class="mdi mdi-file-edit-outline"></i></button>
                        <button type="button" class="btn btn-danger"><i class="mdi mdi-trash-can"></i></button>

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