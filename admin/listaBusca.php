<?php

?>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="mt-5 d-flex justify-content-between align-items-center">
                <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Usuário(s)</h1>

            </div>

            <div class="overflowTable" id="tabelaUser">
                <table class="table table-hover table-bordered border-dark  rounded-table">
                    <thead class="table-dark ">
                    <tr>

                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="40%">Nome Completo</th>
                        <th scope="col" width="35%">Cargo</th>
                        <th scope="col" width="15%" class="no-print">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contar = 1;

                    if (isset($_SESSION['resultadoPesquisaUser'])) {
                        foreach ($_SESSION['resultadoPesquisaUser'] as $item) {
                            $idusuario = $item['idUsuario'];
                            $nome = $item['nomeUsuario'];
                            $sobrenome = $item['sobrenome'];
                            $telefone = $item['numero'];
                            $nascimento = $item['nascimento'];
                            $cpf = $item['cpf'];
                            $cargo = $item['cargo'];
                            $email = $item['email'];

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
                            <tr id="row-<?php echo $idusuario; ?>">
                                <th scope="row"><?php echo $contar ?></th>
                                <td><?php echo "$nome $sobrenome" ?></td>
                                <td><?php echo $cargoTela ?></td>
                                <td class="no-print">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success" style="float: right"
                                                onclick="buscarLinha('listarUsuario','<?php echo $idusuario?>')">
                                            Ver
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            <?php
                            ++$contar;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>Nenhum usuário encontrado!</h4>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mt-5 d-flex justify-content-between align-items-center">
                <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">EPI(s)</h1>

            </div>

            <div class="overflowTable" id="tabelaUser">
                <table class="table table-hover table-bordered border-dark  rounded-table">
                    <thead class="table-dark ">
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Nº CA</th>
                        <th scope="col" class="no-print">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contar = 1;

                    if (isset($_SESSION['resultadoPesquisaEpi'])) {
                        foreach ($_SESSION['resultadoPesquisaEpi'] as $itemEpi) {
                            $idepi = $itemEpi['idEpi'];
                            $nomeEpi = $itemEpi['nomeEpi'];
                            $certificado = $itemEpi['certificado'];

                            ?>
                            <tr id="row-<?php echo $idepi; ?>">
                                <th scope="row"><?php echo $contar ?></th>
                                <td><?php echo $nomeEpi ?></td>
                                <td><?php echo $certificado ?></td>
                                <td class="no-print">
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success" style="float: right"
                                                onclick="buscarLinha('listarEpi','<?php echo $idepi?>')">
                                            Ver
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            <?php
                            ++$contar;
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">
                                <h4>Nenhum EPI foi encontrado!</h4>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
