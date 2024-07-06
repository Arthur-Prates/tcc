<?php

?>
<h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Usuário(s)</h1>
<table class="table table-hover table-bordered border-dark">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nome Completo</th>
        <th scope="col">CPF</th>
        <th scope="col">Cargo</th>
        <th scope="col">Email</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $contar = 1;
    $listaUsuario = listarTabela("*", "usuario");
    if ($listaUsuario) {
        foreach ($listaUsuario as $item) {
            $idusuario = $item -> idusuario;
            $nome = $item -> nomeUsuario;
            $sobrenome = $item -> sobrenome;
            $cpf = $item -> cpf;
            $cargo = $item -> cargo;
            if($cargo== 'adm'){
                $cargo = "Adminstrador";
            }else if($cargo == 'funcionario'){
                $cargo = 'Funcionário';
            }else if($cargo = 'rh'){
                $cargo = "Recursos Humanos";
            }else if($cargo=='almoxarife'){
                $cargo = "Almoxarife";
            }else{
                $cargo = 'Sem cargo';
            }
            $email = $item -> email;
//            idusuario, nome, sobrenome, cpf, nascimento, matricula, cargo, email, senha, cadastro, alteracao, ativo
            ?>
            <tr>
                <th scope="row"><?php echo $contar?></th>
                <td><?php echo "$nome $sobrenome"?></td>
                <td><?php echo $cpf?></td>
                <td><?php echo $cargo?></td>
                <td><?php echo $email?></td>
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