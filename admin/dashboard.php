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
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/4.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#90bae0">

</head>

<body>
<?php
include_once('nav.php');

?>

<div class="">
    <div id='show' class='show'>
        <section class="ondas-box">
            <div class="container">
                <div class="row vai">
                    <form action="verificarAluguel.php" method="get" class="d-flex flex-wrap justify-content-center" id="emprestimoForm">
                        <div class="col-12 col-sm-10 col-md-10 col-lg-10 p-0 d-flex align-items-center">
                            <input type="text" id="emprestimo" name="emprestimo"
                                   class="inputPesquisa text-center w-100 mt-2 text-dark" placeholder="Código">
                        </div>
                        <div class="col-12 col-sm-2 col-md-2 col-lg-2 p-0 d-flex justify-content-center align-items-center mt-2 mt-sm-0">
                            <button type="submit" class="btnAluguelPesquisa"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                    <div class="text-center">
                        <?php
                        if (isset($_GET['erro'])) {
                            ?>
                            <p class="text-danger">Código de empréstimo inexistente!</p>
                            <?php
                        }else if (isset($_GET['error'])){
                            ?>
                            <p class="text-danger">O campo de pesquisa não pode ficar vazio!</p>
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
                <div class=" col-12 col-lg-4 col-md-12 col-sm-12">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <div class="d-flex justify-content-center align-items-center text-white">
                        <canvas id="myChart"></canvas>
                    </div>

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
                                }
                            }
                        });


                    </script>
                </div>

                <div class="col-12 col-lg-4 col-md-12 col-sm-12">
                    <?php
                    // Obtém os dados da função valoresGraficoTopFuncionarios()
                    $dadosGrafico = valoresGraficoTopFuncionarios();

                    // Verifica se os dados não estão vazios
                    if (!empty($dadosGrafico)) {
                        // Inicializa arrays para labels e dados
                        $labels = [];
                        $dados = [];
                        $contador = 0;

                        // Popula os arrays de labels e dados, limitando a 5 elementos
                        foreach ($dadosGrafico as $chave => $valor) {
                            if ($contador < 5) {
                                $labels[] = "'$chave'";
                                $dados[] = $valor;
                                $contador++;
                            }
                        }

                        // Converte arrays para strings para serem usados no JavaScript
                        $labels = implode(",", $labels);
                        $dados = implode(",", $dados);
                    } else {
                        // Caso não haja dados, define valores padrão
                        $labels = "'Sem dados'";
                        $dados = "0";
                    }
                    ?>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <div class="d-flex justify-content-center align-items-center">
                        <canvas id="myChart2"></canvas>
                    </div>
                    <script>
                        // Inicializa o gráfico do tipo 'doughnut' usando Chart.js
                        const ctx2 = document.getElementById('myChart2').getContext('2d');
                        Chart.defaults.color = '#ffffff';
                        Chart.defaults.borderColor = 'rgba(255,255,255,0.1)';
                        new Chart(ctx2, {
                            type: 'doughnut',
                            data: {
                                labels: [<?php echo $labels; ?>],
                                datasets: [{
                                    label: 'Quantidade de empréstimos feitos',
                                    data: [<?php echo $dados; ?>],
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
                                plugins: {
                                    title: {
                                        display: true,
                                        text: 'Líderes em EPI Pendentes',
                                        padding: {
                                            top: 10,
                                            bottom: 30,
                                        }
                                    },
                                    legend: {
                                        display: true
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function (tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    },
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </section>
    </div>
    <button onclick="voltarAoTopo()" id="btnTopo" class="btnTopo" title="Voltar ao Topo"><i
                class="bi bi-arrow-up-short"></i></button>
</div>
<!-- Modal Add Usuario -->
<div class="modal fade" id="modalUsuarioAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioAdd" id="frmUsuarioAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control" id="nomeUsuarioAdd"
                                       name="nomeUsuarioAdd">
                                <span>Nome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control" id="sobrenomeUsuarioAdd"
                                       name="sobrenomeUsuarioAdd">
                                <span>Sobrenome</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control celular"
                                       id="telefoneUsuarioAdd"
                                       name="telefoneUsuarioAdd">
                                <span>Celular</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control cpf" id="CPFUsuarioAdd"
                                       name="CPFUsuarioAdd">
                                <span>CPF</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="date" class="form-control" id="nascimentoUsuarioAdd"
                                       name="nascimentoUsuarioAdd" value='<?php echo Data18AnosAtras() ?>'>
                                <span>Data de Nascimento</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField2 mb-3">
                                <select required="required" class="form-select" aria-label="Default select example"
                                        id="cargoUsuarioAdd" name="cargoUsuarioAdd">
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option selected value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                                <span>Cargo</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="email" class="form-control" id="emailUsuarioAdd"
                                       name="emailUsuarioAdd">
                                <span>Email de acesso</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="password" class="form-control" id="senhaUsuarioAdd"
                                       name="senhaUsuarioAdd">
                                <span>Senha de acesso</span>
                            </div>
                            <label for="senhaUsuarioAdd"
                                   class="olhinho" id="olhinho" onclick="mostrarsenha('senhaUsuarioAdd')"><span
                                        id="btn-senha" class="bi bi-eye"></span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza   btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalAddUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btnDark btn-sm" id="btnUsuarioAdd">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Edit Usuario -->
<div class="modal fade" id="modalUsuarioEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioEdit" id="frmUsuarioEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="formField d-none mb-3">
                                <input type="text" class="form-control" id="idUsuarioEdit" name="idUsuarioEdit">
                                <label class="input-group-text" for="idUsuarioEdit">id</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="nomeUsuarioEdit" name="nomeUsuarioEdit">
                                <span for="nomeUsuarioEdit">Nome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="sobrenomeUsuarioEdit"
                                       name="sobrenomeUsuarioEdit">
                                <span for="sobrenomeUsuarioEdit">Sobrenome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control celular" id="telefoneUsuarioEdit"
                                       name="telefoneUsuarioEdit">
                                <span for="telefoneUsuarioEdit">Celular</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control cpf" id="CPFUsuarioEdit" name="CPFUsuarioEdit">
                                <span for="CPFUsuarioEdit">CPF</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="date" class="form-control" id="nascimentoUsuarioEdit"
                                       name="nascimentoUsuarioEdit"
                                       value='<?php echo Data18AnosAtras() ?>'>
                                <span for="nascimentoUsuarioEdit">Data de Nascimento</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField2 mb-3">
                                <select class="form-select" aria-label="Default select example" id="cargoUsuarioEdit"
                                        name="cargoUsuarioEdit">
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                                <span for="cargoUsuarioEdit">Cargo</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="emailUsuarioEdit" name="emailUsuarioEdit">
                                <span for="emailUsuarioEdit">Email de Acesso</span>
                            </div>
                        </div>

                        <button class="btn btn-info text-white w-100 mb-3" id="btnAlterarSenha" type="button">
                            Alterar senha
                        </button>
                        <button class="btn btn-secondary text-white w-100 mb-3" id="btnFecharAlterarSenha" type="button"
                                style="display: none">
                            Não alterar senha
                        </button>
                        <div id="dNone" style="display: none">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="formField mb-3">
                                        <input type="password" class="form-control" id="novaSenhaUsuarioEdit"
                                               name="novaSenhaUsuarioEdit">
                                        <span for="novaSenhaUsuarioEdit">Digite a nova senha</span>
                                    </div>
                                    <label for="novaSenhaUsuarioEdit" class="olhinho2" id="btn-senha olhinho2"
                                           onclick="mostrarsenha('novaSenhaUsuarioEdit')">
                                        <span class="bi bi-eye"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="formField mb-3">
                                        <input type="password" class="form-control" id="confirmNovaSenhaUsuarioEdit"
                                               name="confirmNovaSenhaUsuarioEdit">
                                        <span for="confirmNovaSenhaUsuarioEdit">Repita a senha</span>
                                    </div>
                                    <label class=" olhinho3" for="confirmNovaSenhaUsuarioEdit" id="btn-senha olhinho3"
                                           onclick="mostrarsenha('confirmNovaSenhaUsuarioEdit')"><span
                                                class="bi bi-eye"></span>
                                    </label>
                                </div>
                            </div>
                            <p class="text-danger text-center" id="alertaSenha" style="display: none"></p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalEditUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btnAzulBostrap btn-sm" id="btnUsuarioEdit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Ver MAIS Usuario -->
<div class="modal fade" id="modalUsuarioVermais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ver mais</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioVermais" id="frmUsuarioVermais">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label for="input" class="text">Name</label>
                                <input type="text" class="form-control mdlVermaisUsuario input" id="nomeUsuarioVermais"
                                       name="nomeUsuarioVermais" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="sobrenomeUsuarioVermais">Sobrenome</label>
                                <input type="text" class="form-control mdlVermaisUsuario input"
                                       id="sobrenomeUsuarioVermais"
                                       name="sobrenomeUsuarioVermais" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="telefoneUsuarioVermais">Celular</label>
                                <input type="text" class="form-control mdlVermaisUsuario input"
                                       id="telefoneUsuarioVermais"
                                       name="telefoneUsuarioVermais" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="CPFUsuarioVermais">CPF</label>
                                <input type="text" class="form-control mdlVermaisUsuario cpf input"
                                       id="CPFUsuarioVermais"
                                       name="CPFUsuarioVermais" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="nascimentoUsuarioVermais">Data de Nascimento</label>
                                <input type="date" class="form-control mdlVermaisUsuario input"
                                       id="nascimentoUsuarioVermais"
                                       name="nascimentoUsuarioVermais"
                                       value='<?php echo Data18AnosAtras() ?>' disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="cargoUsuarioVermais">Cargo</label>
                                <select class="form-select mdlVermaisUsuario select" aria-label="Default select example"
                                        id="cargoUsuarioVermais"
                                        name="cargoUsuarioVermais" disabled>
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="coolinput mb-3">
                                <label class="text" for="emailUsuarioVermais">Email de acesso</label>
                                <input type="text" class="form-control mdlVermaisUsuario input" id="emailUsuarioVermais"
                                       name="emailUsuarioVermais" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalVermaisUsuario">Fechar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal add epi -->
<div class="modal fade" id="modalEpiAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pretoNaoPreto text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar Epi</h1>
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
                               name="certificadoEpiAdd" maxlength="7" minlength="5"/>
                        <span>Certificado</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="number" class="form-control" id="quantidadeEpiAdd"
                               name="quantidadeEpiAdd" maxlength="7" minlength="5"/>
                        <span>Quantidade total</span>
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
            </div>
            <form action="#" method="post" name="frmEpiEdit" id="frmEpiEdit">
                <div class="modal-body">
                    <input type="hidden" name="idEditEpi" id="idEditEpi">
                    <div class="mb-3 divModalBody2">
                        <label for="fotoEpiEdit" class="custum-file-upload2">
                            <img src="../img/produtos/" id="imgPreview" alt="foto-do-epi" width="30%">
                            <input type="file" class="form-control" id="fotoEpiEdit" name="fotoEpiEdit">
                        </label>
                    </div>
                    <div class="formField mb-3 mt-4">
<!--                            <input type="file" class="form-control" id="fotoEpiEdit" name="fotoEpiEdit">-->
                            <span>Sua Foto</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="text" class="form-control" id="nomeEpiEdit" name="nomeEpiEdit"/>
                        <span>Nome do Epi</span>
                    </div>
                    <div class="formField mb-3">
                        <input required="" type="number" class="form-control" id="certificadoEpiEdit"
                               name="certificadoEpiEdit" maxlength="7" minlength="5"/>
                        <span>Certificado</span>
                    </div>
                    <div class="formField mb-3">
                        <input type="number" class="form-control" id="quantidadeEpiEdit"
                               name="quantidadeEpiEdit" maxlength="7"/>
                        <span>Quantidade total</span>
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