<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');

if ($_SESSION['idadm']) {
    $idUsuario = $_SESSION['idadm'];
} else {
    session_destroy();
    header('location: index.php?error=404');
}

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard-Adminstrador</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#ffffff">

</head>

<body>
<?php
include_once('nav.php');

?>
<div class="row">
    <div class="col-2">

    </div>
    <div class="col-10">


    </div>
</div>
<div class="container-fluid">


    <div id='show' class='show'>
        <section class="ondas-box">

            <div class="titulo">
                <div class="row  pesquisaAluguel">
                    <div class="col-12">
                        <div class="d-flex justify-content-center align-items-center">
                            <form action="verificarAluguel.php" method="get">
                                <input type="text" id="codigoAluguel" name="codigoAluguel"
                                       class="inputPesquisa text-center" placeholder="Código">
                                <button type="submit" class="btn btnAluguelPesquisa"><i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <img src="../img/wave.png" alt="onda" class="oondafoto">
        <section class="conteudo">
            <div class="row d-flex justify-content-between align-items-center ">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class=" d-flex justify-content-center align-items-center ">
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('myChart');
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Reservado', 'Não Reservados'],
                                datasets: [{
                                    label: '',

                                    data: ['<?php  echo valoresGraficoQuantidadeEpi('indisponivel') ?>', '<?php  echo valoresGraficoQuantidadeEpi('disponivel');?>'],

                                    backgroundColor: [
                                        'rgba(219,2,2,0.8)',
                                        'rgba(42,197,143,0.8)'
                                    ],
                                    borderColor: [
                                        'rgba(219,2,2)',
                                        'rgba(42,197,143)'

                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Quantidade de Items Reservados',
                                        padding: {
                                            top: 10,
                                            bottom: 30
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });


                    </script>

                </div>

                //

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class=" d-flex justify-content-center align-items-center ">
                        <canvas id="myChart2"></canvas>
                    </div>

                    <script>
                        const ctx2 = document.getElementById('myChart2');
                        new Chart(ctx2, {
                            type: 'doughnut',
                            data: {
                                labels: [
                                    <?php
                                    $numPeople = 0;
                                    $TOTALFIMEND = valoresGraficoTopFuncionarios();
                                    foreach ($TOTALFIMEND as $key => $value) {
                                        if ($numPeople < 5) {

                                            echo "'$key',";

                                        }
                                        $numPeople = $numPeople + 1;
                                    }
                                    ?>
                                ],
                                datasets: [{
                                    label: 'Quantidade de Aluguéis feitos',

                                    data: [
                                        <?php
                                        $numValores = 0;
                                        $TOTALFIMEND = valoresGraficoTopFuncionarios();
                                        foreach ($TOTALFIMEND as $key => $value) {
                                            if ($numValores < 5) {
                                                echo "'$value',";

                                                $numValores = $numValores + 1;
                                            }
                                        }
                                        ?>,
                                    ],

                                    backgroundColor: [
                                        'rgba(183, 28, 28,0.8)',
                                        'rgba(255, 111, 0,0.8)',
                                        'rgba(255,186,8,0.8)',
                                        'rgba(63,132,229,0.8)',
                                        'rgba(22,152,115,0.8)',

                                    ],
                                    borderColor: [
                                        'rgba(183, 28, 28)',
                                        'rgba(255, 111, 0)',
                                        'rgba(255,186,8)',
                                        'rgba(63,132,229)',
                                        'rgba(22,152,115)',


                                    ],
                                    borderWidth: 2
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>

                </div>
            </div>
        </section>

    </div>
</div>

<!-- Modal add epi -->

<div class="modal fade" id="modalEpiAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Epi</h1>
                <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form method="post" name="frmEpiAdd" id="frmEpiAdd">

                <div class="modal-body quasebranco ">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="fotoEpiAdd" name="fotoEpiAdd">
                        <label class="input-group-text" for="fotoEpiAdd">Foto</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomeEpiAdd" name="nomeEpiAdd">
                        <label class="input-group-text" for="nomeEpiAdd">Nome do Epi</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="certificadoEpiAdd" name="certificadoEpiAdd"
                               maxlength="7" minlength="5">
                        <label class="input-group-text" for="certificadoEpiAdd">Certificado</label>
                    </div>
                </div>
                <div class="modal-footer quasebranco ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnFecharModalAddEpi">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-success" id="btnEpiAdd">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal edit epi -->
<div class="modal fade" id="modalEpiEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header ">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar EPI</h1>
                <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="#" method="post" name="frmEpiEdit" id="frmEpiEdit">
                <div class="modal-body">
                    <input type="hidden" name="idEditEpi" id="idEditEpi">
                    <div class="col-12 text-center mb-2 alturaFotoPreview">
                        <img src="../img/produtos/" id="imgPreview" alt="foto-do-epi" width="50%">
                    </div>
                    <div class="input-group mb-3 mt-4">
                        <input type="file" class="form-control" id="fotoEpiEdit" name="fotoEpiEdit">
                        <label class="input-group-text" for="fotoEpiEdit">Foto</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomeEpiEdit" name="nomeEpiEdit">
                        <label class="input-group-text" for="nomeEpiEdit">Nome do Epi</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="certificadoEpiEdit" name="certificadoEpiEdit"
                               maxlength="7" minlength="5">
                        <label class="input-group-text" for="certificadoEpiEdit">Certificado</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalEditEpi">Fechar
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm" id="btnEpiEdit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Add Usuario -->
<div class="modal fade" id="modalUsuarioAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioAdd" id="frmUsuarioAdd">
                <div class="modal-body">

                    <div class="input-group mb-3">
                        <input required="required" type="text" class="form-control" id="nomeUsuarioAdd"
                               name="nomeUsuarioAdd">
                        <label class="input-group-text" for="nomeUsuarioAdd">Nome</label>
                    </div>
                    <div class="input-group mb-3">
                        <input required="required" type="text" class="form-control" id="sobrenomeUsuarioAdd"
                               name="sobrenomeUsuarioAdd">
                        <label class="input-group-text" for="sobrenomeUsuarioAdd">Sobrenome</label>
                    </div>
                    <div class="input-group mb-3">
                        <input required="required" type="text" class="form-control celular" id="telefoneUsuarioAdd"
                               name="telefoneUsuarioAdd">
                        <label class="input-group-text" for="telefoneUsuarioAdd">Celular</label>
                    </div>
                    <div class="input-group mb-3">
                        <input required="required" type="text" class="form-control cpf" id="CPFUsuarioAdd"
                               name="CPFUsuarioAdd">
                        <label class="input-group-text" for="CPFUsuarioAdd">CPF</label>
                    </div>
                    <div class="input-group mb-3">
                        <input required="required" type="date" class="form-control" id="nascimentoUsuarioAdd"
                               name="nascimentoUsuarioAdd" value='<?php echo Data18AnosAtras() ?>'>
                        <label class="input-group-text" for="nascimentoUsuarioAdd">Data de Nascimento</label>
                    </div>

                    <div class="input-group mb-3">
                        <select required="required" class="form-select" aria-label="Default select example"
                                id="cargoUsuarioAdd" name="cargoUsuarioAdd">
                            <option value="adm">Adminstrador</option>
                            <option value="almoxarife">Almoxarife</option>
                            <option selected value="funcionario">Funcionário</option>
                            <option value="rh">Recursos Humanos</option>
                        </select>
                        <label class="input-group-text" for="nomeUsuarioAdd">Cargo</label>
                    </div>
                    <div class="input-group mb-3">
                        <input required="required" type="email" class="form-control" id="emailUsuarioAdd"
                               name="emailUsuarioAdd">
                        <label class="input-group-text" for="emailUsuarioAdd">Email de acesso</label>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="senhaUsuarioAdd" id="btn-senha"
                               onclick="mostrarsenha('senhaUsuarioAdd')"><span class="bi bi-eye"></span></label>

                        <input required="required" type="password" class="form-control" id="senhaUsuarioAdd"
                               name="senhaUsuarioAdd">
                        <label class="input-group-text" for="senhaUsuarioAdd">Senha de acesso</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalAddUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btn-dark btn-sm" id="btnUsuarioAdd">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Usuario -->
<div class="modal fade" id="modalUsuarioEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioEdit" id="frmUsuarioEdit">
                <div class="modal-body">
                    <div class="input-group d-none mb-3">
                        <input type="text" class="form-control" id="idUsuarioEdit" name="idUsuarioEdit">
                        <label class="input-group-text" for="idUsuarioEdit">id</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomeUsuarioEdit" name="nomeUsuarioEdit">
                        <label class="input-group-text" for="nomeUsuarioEdit">Nome</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="sobrenomeUsuarioEdit" name="sobrenomeUsuarioEdit">
                        <label class="input-group-text" for="sobrenomeUsuarioEdit">Sobrenome</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control celular" id="telefoneUsuarioEdit" name="telefoneUsuarioEdit">
                        <label class="input-group-text" for="telefoneUsuarioEdit">Celular</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control cpf" id="CPFUsuarioEdit" name="CPFUsuarioEdit">
                        <label class="input-group-text" for="CPFUsuarioEdit">CPF</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="nascimentoUsuarioEdit" name="nascimentoUsuarioEdit"
                               value='<?php echo Data18AnosAtras() ?>'>
                        <label class="input-group-text" for="nascimentoUsuarioEdit">Data de Nascimento</label>
                    </div>

                    <div class="input-group mb-3">
                        <select class="form-select" aria-label="Default select example" id="cargoUsuarioEdit"
                                name="cargoUsuarioEdit">
                            <option value="adm">Adminstrador</option>
                            <option value="almoxarife">Almoxarife</option>
                            <option value="funcionario">Funcionário</option>
                            <option value="rh">Recursos Humanos</option>
                        </select>
                        <label class="input-group-text" for="nomeUsuarioEdit">Cargo</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="emailUsuarioEdit" name="emailUsuarioEdit">
                        <label class="input-group-text" for="emailUsuarioEdit">Email de acesso</label>
                    </div>
                    <button class="btn btn-info text-white w-100 mb-3" id="btnAlterarSenha" type="button">
                        Alterar senha
                    </button>
                    <button class="btn btn-secondary text-white w-100 mb-3" id="btnFecharAlterarSenha" type="button" style="display: none">
                        Não alterar senha
                    </button>
                    <div id="dNone" style="display: none">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="novaSenhaUsuarioEdit" id="btn-senha"
                                   onclick="mostrarsenha('novaSenhaUsuarioEdit')"><span class="bi bi-eye"></span></label>
                            <input type="password" class="form-control" id="novaSenhaUsuarioEdit"
                                   name="novaSenhaUsuarioEdit">
                            <label class="input-group-text" for="novaSenhaUsuarioEdit">Digite a nova senha</label>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="confirmNovaSenhaUsuarioEdit" id="btn-senha"
                                   onclick="mostrarsenha('confirmNovaSenhaUsuarioEdit')"><span
                                        class="bi bi-eye"></span></label>
                            <input type="password" class="form-control" id="confirmNovaSenhaUsuarioEdit"
                                   name="confirmNovaSenhaUsuarioEdit">
                            <label class="input-group-text" for="confirmNovaSenhaUsuarioEdit">Repita a senha</label>
                        </div>
                        <p class="text-danger" id="alertaSenha" style="display: none"></p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalEditUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btn-dark btn-sm" id="btnUsuarioEdit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Usuario -->
<div class="modal fade" id="modalUsuarioVermais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ver mais</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioVermais" id="frmUsuarioVermais">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="nomeUsuarioVermais">Nome</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="nomeUsuarioVermais" name="nomeUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="sobrenomeUsuarioVermais">Sobrenome</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="sobrenomeUsuarioVermais" name="sobrenomeUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="telefoneUsuarioVermais">Celular</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="telefoneUsuarioVermais" name="telefoneUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="CPFUsuarioVermais">CPF</label>
                        <input type="text" class="form-control mdlVermaisUsuario cpf" id="CPFUsuarioVermais" name="CPFUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="nascimentoUsuarioVermais">Data de Nascimento</label>
                        <input type="date" class="form-control mdlVermaisUsuario" id="nascimentoUsuarioVermais" name="nascimentoUsuarioVermais"
                               value='<?php echo Data18AnosAtras() ?>' disabled>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="nomeUsuarioVermais">Cargo</label>
                        <select class="form-select mdlVermaisUsuario" aria-label="Default select example" id="cargoUsuarioVermais"
                                name="cargoUsuarioVermais" disabled>
                            <option value="adm">Adminstrador</option>
                            <option value="almoxarife">Almoxarife</option>
                            <option value="funcionario">Funcionário</option>
                            <option value="rh">Recursos Humanos</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="emailUsuarioVermais">Email de acesso</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="emailUsuarioVermais" name="emailUsuarioVermais" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalVermaisUsuario">Fechar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
        integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
<script src="../js/script.js"></script>


</body>

</html>