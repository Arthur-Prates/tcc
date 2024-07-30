<?php

?>
<div class="container">
    <div class="mt-5 d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Usuário(s)</h1>

        <form action="" method="post" name="buscaUsuario" id="buscaUsuario" class="buscaUsuario">
            <div class="formField3">
                <input type="text" class="" id="buscarUsuario" name="buscarUsuario" placeholder="">
                <span>Digite o nome do usuário</span>
            </div>
            <button type="submit" class="btn btnDark btnDarkUsuario"><i class="bi bi-search"></i></button>
        </form>
        <div class="d-flex align-items-center">

            <button class="btn btnAmareloBos mx-1 " onclick="imprimir('Lista de Usuarios do Sistema','tabelaUser')"><i
                        class="bi bi-printer"></i></button>
            <button type="button" class="btn btnDark"
                    onclick="abrirModalUsuario('nao','nao','nao','nao', 'nao','nao','nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'modalUsuarioAdd', 'A', 'btnUsuarioAdd', 'addUsuario', 'frmUsuarioAdd')">
                Cadastrar
            </button>
        </div>
    </div>

    <div class="overflowTable" id="tabelaUser">
        <table class="table table-hover table-bordered border-dark  rounded-table">
            <thead class="table-dark ">
            <tr>

                <th scope="col">#</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">CPF</th>
                <th scope="col">Cargo</th>
                <th scope="col">Email</th>
                <th scope="col" class="no-print">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = 1;
            $listaUsuario = listarTabela("*", 'usuario');
            if ($listaUsuario) {
                foreach ($listaUsuario as $item) {
                    $idusuario = $item->idusuario;
                    $nome = $item->nomeUsuario;
                    $sobrenome = $item->sobrenome;
                    $telefone = $item->numero;
                    $nascimento = $item->nascimento;
                    $cpf = $item->cpf;
                    $cargo = $item->cargo;
                    $email = $item->email;
                    if ($telefone == '') {
                        $telefone = 'Sem telefone';
                    }

                    if ($cargo == 'adm') {
                        $cargoTela = "Administrator";
                    } else if ($cargo == 'funcionario') {
                        $cargoTela = 'Funcionário';
                    } else if ($cargo == 'rh') {
                        $cargoTela = "Recursos Humanos";
                    } else if ($cargo == 'almoxarife') {
                        $cargoTela = "Almoxarife";
                    } else {
                        $cargoTela = 'Sem cargo';
                    }

                    ?>
                    <tr>
                        <th scope="row"><?php echo $contar ?></th>
                        <td><?php echo "$nome $sobrenome" ?></td>
                        <td><?php echo $cpf ?></td>
                        <td><?php echo $cargoTela ?></td>
                        <td><?php echo $email ?></td>
                        <td class="no-print">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-success" style="float: right"
                                        onclick="abrirModalUsuario('nao','nao','nomeUsuarioVermais','<?php echo $nome; ?>', 'sobrenomeUsuarioVermais','<?php echo $sobrenome; ?>','telefoneUsuarioVermais','<?php echo $telefone ?>', 'CPFUsuarioVermais','<?php echo $cpf; ?>', 'nascimentoUsuarioVermais','<?php echo $nascimento; ?>', 'cargoUsuarioVermais','<?php echo $cargo; ?>', 'emailUsuarioVermais','<?php echo $email; ?>', 'nao','nao','modalUsuarioVermais', 'A', 'nao', 'editUsuario', 'frmUsuarioVermais')">
                                    <i class="bi bi-person-lines-fill"></i>
                                </button>
                                <?php
                                if ($_SESSION['cargo'] !== 'almoxarife') {
                                    ?>
                                    <button type="button" class="btn btn-info" style="float: right"
                                            onclick="abrirModalUsuario('idUsuarioEdit','<?php echo $idusuario; ?>','nomeUsuarioEdit','<?php echo $nome; ?>', 'sobrenomeUsuarioEdit','<?php echo $sobrenome; ?>','telefoneUsuarioEdit','<?php echo $telefone ?>', 'CPFUsuarioEdit','<?php echo $cpf; ?>', 'nascimentoUsuarioEdit','<?php echo $nascimento; ?>', 'cargoUsuarioEdit','<?php echo $cargo; ?>', 'emailUsuarioEdit','<?php echo $email; ?>', 'nao','nao','modalUsuarioEdit', 'A', 'btnUsuarioEdit', 'editUsuario', 'frmUsuarioEdit')">
                                        <i class="mdi mdi-file-edit-outline"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger"
                                            onclick="deleletarUsuario('<?php echo $idusuario; ?>','deleteUsuario')"><i
                                                class="mdi mdi-trash-can"></i>
                                    </button>
                                    <?php
                                }
                                ?>

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
    </div>
</div>
