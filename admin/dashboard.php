<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
//include_once('listarEpi.php');

if ($_SESSION['idadm']) {
    $idUsuario = $_SESSION['idadm'];
} else {
    session_destroy();
    header('location: index.php?error=404');
}


$listarEmprestimo = 'NAO';

?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Adminstrador</title>

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
<div class="">
    <div id='show' class='show'>
        <section class="ondas-box">
            <div class="container">
                <div class="row vai">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-10 ">
                        <form action="verificarAluguel.php" method="get">
                            <input type="text" id="emprestimo" name="emprestimo"
                                   class="inputPesquisa text-center w-100  mt-2" placeholder="Código">
                    </div>
                    <div class="d-flex justify-content-center align-items-center col-12 col-sm-12 col-md-2 col-lg-2 mt-2">
                        <button type="submit" class="btnAluguelPesquisa"><i class="bi bi-search"></i>
                        </button>
                    </div>
                    </form>
                    <div class="text-center">
                        <?php
                        if (isset($_GET['erro'])){
                            ?>
                            <p class="text-danger">Nenhum empréstimo encontrado!</p>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <img src="../img/wave.svg" alt="onda" class="oondafoto">
        <section class="conteudo">
            <div class="row d-flex justify-content-between align-items-center ">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <div class=" d-flex justify-content-center align-items-center text-white">
                        <canvas id="myChart"></canvas>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        const ctx = document.getElementById('myChart');
                        Chart.defaults.color = '#ffffff';
                        Chart.defaults.borderColor = 'rgba(255,255,255,0.1)';
                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Reservado', 'Não Reservados'],
                                datasets: [{


                                    data: ['<?php  echo valoresGraficoQuantidadeEpi('indisponivel') ?>', '<?php  echo valoresGraficoQuantidadeEpi('disponivel');?>'],

                                    backgroundColor: [
                                        'rgba(219,2,2,0.8)',
                                        'rgba(42,197,143,0.8)'
                                    ],
                                    borderColor: [
                                        'rgba(219,2,2)',
                                        'rgba(42,197,143)'

                                    ],
                                    borderWidth: 2,
                                }]
                            },
                            options: {
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Quantidade de Items Reservados',
                                        padding: {
                                            top: 10,
                                            bottom: 30,
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                    }
                                }
                            }
                        });


                    </script>

                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">
                    <?php
                    $verificarVazio = valoresGraficoTopFuncionarios();
                    foreach ($verificarVazio as $chave => $valor) {
                        if (!empty($valor)) {
                            ?>

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
                                                beginAtZero: true                           }
                                        }
                                    }
                                });
                            </script>
                            <?php

                        }

                    }
                    ?>

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
            <div class="modal-header pretoNaoPreto text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Epi</h1>
                <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form method="post" name="frmEpiAdd" id="frmEpiAdd">

                <div class="modal-body quasebranco  ">

                    <div class="mb-3 divModalBody">
                        <label for="fotoEpiAdd" class="custum-file-upload">
                            <div class="icon" id="icon">
                                <svg viewBox="0 0 24 24" fill="" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                                              fill=""></path>
                                    </g>
                                </svg>
                            </div>
                            <div class="text" id="text">
                                <span>Selecione sua imagem</span>
                            </div>
                            <img id="preview" src="" alt="Preview da imagem" class="img-fluid">
                            <input type="file" class="form-control" id="fotoEpiAdd" name="fotoEpiAdd">
                        </label>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="text" class="form-control" id="nomeEpiAdd" name="nomeEpiAdd"/>
                        <span>Nome do Epi</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="text" class="form-control" id="certificadoEpiAdd"
                               name="certificadoEpiAdd"  maxlength="7" minlength="5"/>
                        <span>Certificado</span>
                    </div>
                </div>
                <div class="modal-footer quasebranco ">
                    <button type="button" class="btn btnCinza btn-sm" data-bs-dismiss="modal" id="btnFecharModalAddEpi">
                        Fechar
                    </button>
                    <button type="submit" class="btn btnDark btn-dark btn-sm" id="btnEpiAdd">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal edit epi -->
<div class="modal fade" id="modalEpiEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header azul">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Alterar EPI</h1>
                <!--                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="#" method="post" name="frmEpiEdit" id="frmEpiEdit">
                <div class="modal-body">
                    <input type="hidden" name="idEditEpi" id="idEditEpi">
                    <div class="col-12 text-center mb-2 alturaFotoPreview">
                        <img src="../img/produtos/" id="imgPreview" alt="foto-do-epi" width="30%">
                    </div>

                    <div class="formField mb-3 mt-4">
                        <input type="file" class="form-control" id="fotoEpiEdit" name="fotoEpiEdit">
                        <span>Foto</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="text" class="form-control" id="nomeEpiEdit" name="nomeEpiEdit"/>
                        <span>Nome do Epi</span>
                    </div>
                    <div class="formField mb-3">
                        <input required=""type="text" class="form-control" id="certificadoEpiEdit" name="certificadoEpiEdit" maxlength="7" minlength="5"/>
                        <span>Certificado</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCinza btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalEditEpi">Fechar
                    </button>
                    <button type="submit" class="btn btn-primary btnAzul btn-sm" id="btnEpiEdit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Add Usuario -->
<div class="modal fade" id="modalUsuarioAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioAdd" id="frmUsuarioAdd">
                <div class="modal-body">
                    <div class="formField mb-3">
                        <input required="required" type="text" class="form-control" id="nomeUsuarioAdd"
                               name="nomeUsuarioAdd">
                        <span>Nome</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="required" type="text" class="form-control" id="sobrenomeUsuarioAdd"
                               name="sobrenomeUsuarioAdd">
                        <span>Sobrenome</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="required" type="text" class="form-control celular" id="telefoneUsuarioAdd"
                               name="telefoneUsuarioAdd">
                        <span>Celular</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="required" type="text" class="form-control cpf" id="CPFUsuarioAdd"
                               name="CPFUsuarioAdd">
                        <span>CPF</span>
                    </div>
<!--                    <div class="input-group mb-3">-->
<!--                        <input required="required" type="text" class="form-control" id="nomeUsuarioAdd"-->
<!--                               name="nomeUsuarioAdd">-->
<!--                        <label class="input-group-text" for="nomeUsuarioAdd">Nome</label>-->
<!--                    </div>-->
<!--                    <div class="input-group mb-3">-->
<!--                        <input required="required" type="text" class="form-control" id="sobrenomeUsuarioAdd"-->
<!--                               name="sobrenomeUsuarioAdd">-->
<!--                        <label class="input-group-text" for="sobrenomeUsuarioAdd">Sobrenome</label>-->
<!--                    </div>-->
<!--                    <div class="input-group mb-3">-->
<!--                        <input required="required" type="text" class="form-control celular" id="telefoneUsuarioAdd"-->
<!--                               name="telefoneUsuarioAdd">-->
<!--                        <label class="input-group-text" for="telefoneUsuarioAdd">Celular</label>-->
<!--                    </div>-->
<!--                    <div class="input-group mb-3">-->
<!--                        <input required="required" type="text" class="form-control cpf" id="CPFUsuarioAdd"-->
<!--                               name="CPFUsuarioAdd">-->
<!--                        <label class="input-group-text" for="CPFUsuarioAdd">CPF</label>-->
<!--                    </div>-->
                    <div class="formField mb-3">
                        <input required="required" type="date" class="form-control" id="nascimentoUsuarioAdd"
                               name="nascimentoUsuarioAdd" value='<?php echo Data18AnosAtras() ?>'>
<!--                        <label class="input-group-text" for="nascimentoUsuarioAdd">Data de Nascimento</label>-->
                        <span>Data de Nascimento</span>
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
                    <div class="formField mb-3">
                        <input required="required" type="email" class="form-control" id="emailUsuarioAdd"
                               name="emailUsuarioAdd">
<!--                        <label class="input-group-text" for="emailUsuarioAdd">Email de acesso</label>-->
                        <span>Email de acesso</span>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="senhaUsuarioAdd" id="btn-senha"
                               onclick="mostrarsenha('senhaUsuarioAdd')"><span class="bi bi-eye"></span></label>

                        <input required="required" type="password" class="form-control" id="senhaUsuarioAdd"
                               name="senhaUsuarioAdd">
                        <label class="input-group-text" for="senhaUsuarioAdd">Senha de acesso</label>
<!--                        <span>Senha de acesso</span>-->
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
                        <input type="text" class="form-control celular" id="telefoneUsuarioEdit"
                               name="telefoneUsuarioEdit">
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
                    <button class="btn btn-secondary text-white w-100 mb-3" id="btnFecharAlterarSenha" type="button"
                            style="display: none">
                        Não alterar senha
                    </button>
                    <div id="dNone" style="display: none">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="novaSenhaUsuarioEdit" id="btn-senha"
                                   onclick="mostrarsenha('novaSenhaUsuarioEdit')"><span
                                        class="bi bi-eye"></span></label>
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

<!-- Modal Ver MAIS Usuario -->
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
                        <input type="text" class="form-control mdlVermaisUsuario" id="nomeUsuarioVermais"
                               name="nomeUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="sobrenomeUsuarioVermais">Sobrenome</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="sobrenomeUsuarioVermais"
                               name="sobrenomeUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="telefoneUsuarioVermais">Celular</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="telefoneUsuarioVermais"
                               name="telefoneUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="CPFUsuarioVermais">CPF</label>
                        <input type="text" class="form-control mdlVermaisUsuario cpf" id="CPFUsuarioVermais"
                               name="CPFUsuarioVermais" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="nascimentoUsuarioVermais">Data de Nascimento</label>
                        <input type="date" class="form-control mdlVermaisUsuario" id="nascimentoUsuarioVermais"
                               name="nascimentoUsuarioVermais"
                               value='<?php echo Data18AnosAtras() ?>' disabled>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="nomeUsuarioVermais">Cargo</label>
                        <select class="form-select mdlVermaisUsuario" aria-label="Default select example"
                                id="cargoUsuarioVermais"
                                name="cargoUsuarioVermais" disabled>
                            <option value="adm">Adminstrador</option>
                            <option value="almoxarife">Almoxarife</option>
                            <option value="funcionario">Funcionário</option>
                            <option value="rh">Recursos Humanos</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="emailUsuarioVermais">Email de acesso</label>
                        <input type="text" class="form-control mdlVermaisUsuario" id="emailUsuarioVermais"
                               name="emailUsuarioVermais" disabled>
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

<script>
    document.getElementById('fotoEpiAdd').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').style.display = 'block';
                document.getElementById('icon').style.display = "none";
                document.getElementById('text').style.display = "none";
            }
            reader.readAsDataURL(file);
        }
    });

</script>
</body>

</html>