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

$codigoEmprestimo = filter_input(INPUT_GET, 'emprestimo', FILTER_SANITIZE_STRING);
$codigoEmprestimo = str_replace(' ', '', $codigoEmprestimo);
if (empty($codigoEmprestimo)) {
    header('location: dashboard.php?error=404');
}
$link = "https://exclusivyweb.com.br/05/admin/verificarAluguel.php?emprestimo=$codigoEmprestimo"
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empréstimo - #<?php echo $codigoEmprestimo ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/4.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="../css/style.css">
</head>


<body>
<?php
$listarEmprestimo = 'SIM';
include_once('nav.php');

$verificarSeCodEmprestimoExiste = listarItemExpecifico('*', 'emprestimo', 'codigoEmprestimo', $codigoEmprestimo);
if ($verificarSeCodEmprestimoExiste !== 'Vazio') {
    foreach ($verificarSeCodEmprestimoExiste as $itemVerificar) {
        $verficacao = true;
    }
}

$nao = 0;
$contarNao = listarItemExpecifico('*', 'produtoemprestimo', 'codEmprestimo', "$codigoEmprestimo");
if ($contarNao !== 'Vazio') {
    foreach ($contarNao as $itemContar) {
        $n = $itemContar->devolucao;
        if ($n == 'N') {
            ++$nao;
        }

    }
} else {
    $nao = 1;
}


?>

<div class="container  listing-container mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-1">Empréstimo - <b> #<?php echo $codigoEmprestimo ?></b></h1>
        <?php

        if ($nao >= 1) {
            ?>
            <div>
                <button class="btn btn-sm btn-success" disabled>Fechar Emprestimo</button>
            </div>
            <?php
        } else {
            ?>

            <div>
                <button class="btn btn-sm btn-success" id="fecharEmprestimo"
                        onclick="devolverEmprestimo('emprestimoDevolvido','<?php echo $codigoEmprestimo ?>','S')">
                    Fechar Emprestimo
                </button>
                <button class="btn btn-sm btn-primary" id="editarEmprestimo"
                        onclick="devolverEmprestimo('emprestimoDevolvido','<?php echo $codigoEmprestimo ?>','N')">
                    Editar
                </button>
            </div>

            <?php
        }
        ?>
    </div>


    <?php

    $listaAlguel = listarTabelaInnerJoinQuadruploWhere('*', 'emprestimo', 'usuario', 'produtoEmprestimo', 'epi', 'idusuario', 'idusuario', 'codigoEmprestimo', 'codEmprestimo', 'idepi', 'idepi', 'd.codEmprestimo', "$codigoEmprestimo", 'horaFim', 'DESC');
    if ($listaAlguel !== 'Vazio') {
    $nomeEpi = array();
    $idepi = array();
    $quantidade = array();

    foreach ($listaAlguel as $item) {
        $ativo = $item->ativo;
        if ($ativo === 'A') {
            $id = $item->idusuario;
            $nomeUsuario = $item->nomeUsuario;
            $telefone = $item->numero;
            array_push($idepi, $item->idepi);
            array_push($nomeEpi, $item->nomeEpi);
            $epi = array_combine($idepi, $nomeEpi);
            array_push($quantidade, $item->quantidade);
            $prioridade = $item->prioridade;
            $dataEmprestimo = $item->dataEmprestimo;
            $email = $item->email;
            $telefone = $item->numero;
            $observacao = $item->observacao;
            $statusEmprestimo = $item->devolvido;
            $status = $statusEmprestimo;

            if ($observacao == 'NAO') {
                $observacao = 'Não';
            }

            if ($statusEmprestimo == 'S') {
                $statusEmprestimo = 'Empréstimo devolvido';
                ?>


                <?php
            } else {
                $statusEmprestimo = 'EPI(s) pendente(s)';
                $statusEmprestimo = "$nao $statusEmprestimo";
            }

            if ($telefone == '' || $telefone == null) {
                $telefone = 'Nenhum telefone cadastrado!';
            }

            $dataEmprestimo = implode("/", array_reverse(explode("-", $dataEmprestimo)));
        }
    }
    if ($status == 'S') {
        ?>
        <script>
            let emprestimo = document.getElementById('fecharEmprestimo');
            let editar = document.getElementById('editarEmprestimo');
            if (emprestimo) {
                emprestimo.hidden = true;
                emprestimo.disabled = true;
            }
            if (editar) {
                editar.hidden = false;
                editar.disabled = false;
            }
        </script>
    <?php
    }else{
    ?>
        <script>
            let emprestimo = document.getElementById('fecharEmprestimo');
            let editar = document.getElementById('editarEmprestimo');
            if (emprestimo) {
                emprestimo.hidden = false;
                emprestimo.disabled = false;
            }
            if (editar) {
                editar.hidden = true;
                editar.disabled = true;

            }
        </script>

        <?php
    }

    ?>
    <div class="row">
        <div class="col-lg-12 col-12 mt-4 text-center listing-item">
            <p><b>Data:</b> <?php echo $dataEmprestimo ?></p>
        </div>
        <div class="col-lg-6 col-12 mt-4 text-center listing-item">
            <p><b>Nome:</b> <?php echo $nomeUsuario ?></p>
            <p><b>Email:</b> <?php echo $email ?></p>
            <p><b>Telefone:</b> <?php echo $telefone ?></p>

        </div>
        <div class="col-lg-6 col-12 mt-4 text-center listing-item">
            <p><b>Prioridade:</b> <?php
                if ($prioridade == '3') {
                    $prioridadeVisivel = 'Alta';
                } else if ($prioridade == '2') {
                    $prioridadeVisivel = 'Média';
                } else {
                    $prioridadeVisivel = 'Baixa';
                }

                echo $prioridadeVisivel;
                ?></p>
            <p><b>Observação:</b> <?php echo $observacao ?></p>
            <p><b>Status do empréstimo:</b> <?php echo $statusEmprestimo ?></p>
        </div>

        <div class="row">
            <div class="col-lg-12 col-12 mt-5">
                <h2 class="mt-5 mb-4">EPI(s) emprestadas</h2>
                <div class="row">
                    <?php
                    $selectCompras = listarTabelaInnerJoinOrdenadaExpecifica('*', 'epi', 'produtoemprestimo', 'idepi', 'idepi', 'b.codEmprestimo', $codigoEmprestimo, 'a.idepi', 'ASC');

                    if ($selectCompras) {
                        foreach ($selectCompras as $item) {
                            $idepi = $item->idepi;
                            $nome = $item->nomeEpi;
                            $foto = $item->foto;
                            $CA = $item->certificado;
                            $quantidade = $item->quantidade;
                            $idItemEpi = $item->idepi;
                            $itemDevolvido = $item->devolucao;


                            ?>

                            <div class="col-12 col-sm-12 col-md-6 col-lg-4 mt-3">
                                <div class="accordion" id="idDoTrem<?php echo $idepi ?>">
                                    <div class="accordion-item ">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button esticaTrem  collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#abrirTreco<?php echo $idepi ?>"
                                                    aria-expanded="true" aria-controls="abrirTreco<?php echo $idepi ?>">
                                                <h5 class="card-title tituloCard"><?php echo $nome ?></h5>
                                            </button>
                                        </h2>
                                        <div id="abrirTreco<?php echo $idepi ?>"
                                             class="accordion-collapse collapse"
                                             data-bs-parent="#idDoTrem<?php echo $idepi ?>">
                                            <div class="accordion-body">
                                                <div class="card mb-3 item cardeCarrossel">
                                                    <div class="row g-0 d-flex justify-content-center align-items-center">
                                                        <div class="col-8 d-flex justify-content-center align-items-center">
                                                            <img src="../img/produtos/<?php echo $foto ?>"
                                                                 class="img-fluid rounded-start"
                                                                 alt="foto do epi: <?php echo $nome ?>">
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <div class="card-body">
                                                                <h4 class="card-title tituloCard"><?php echo $nome ?></h4>
                                                                <p class="card-text"><?php echo $quantidade . ' Unidade(s)' ?></p>
                                                                <p class="card-text"><b>CA:</b> <?php echo $CA ?></p>
                                                                <hr>
                                                                <div class="text-center divBtn">
                                                                    <?php
                                                                    if ($status == 'S') {
                                                                        if ($itemDevolvido == 'N') {
                                                                            ?>
                                                                            <button class="btn btn-sm btn-success"
                                                                                    disabled>
                                                                                Devolvido
                                                                            </button>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <button class="btn btn-sm btn-secondary"
                                                                                    disabled>
                                                                                Não devolvido
                                                                            </button>
                                                                            <?php
                                                                        }
                                                                    } else {
                                                                        if ($itemDevolvido == 'N') {
                                                                            ?>
                                                                            <button class="btn btn-sm btn-success"
                                                                                    onclick="abrirModalDevolucaoEpi('<?php echo $idepi ?>','idEpiDevolucao','<?php echo $codigoEmprestimo ?>','codigoDoEmprestimo','<?php echo $nome ?>','S','<?php echo $quantidade ?>','mdlDevolverEpi','A','btnDevolverEpi','devolverEpi','formDevolucaoEpi')">
                                                                                Devolvido
                                                                            </button>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <button class="btn btn-sm btn-secondary"
                                                                                    onclick="devolverEpi('<?php echo $idItemEpi ?>','naoDevolvido','N','<?php echo $codigoEmprestimo ?>','<?php echo $quantidade ?>','bomEstado')">
                                                                                Não devolvido
                                                                            </button>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    } else {
                        ?>
                        <div class="d-flex justify-content-center align-items-center">
                            <dotlottie-player src="../img/animacao-busca-vazia.json"
                                              background="transparent" speed="1" style="width: 300px; height: 300px;"
                                              loop
                                              autoplay></dotlottie-player>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <p class="fs-3">Empréstimo inexistente!</p>

                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <button onclick="voltarAoTopo()" id="btnTopo" class="btnTopo" title="Voltar ao Topo"><i
                class="bi bi-arrow-up-short"></i></button>
</div>

<!-- Modal devolucao do epi-->
<div class="modal fade" id="mdlDevolverEpi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-black bg-success">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Devolução do EPI</h1>
            </div>
            <form action="#" name="formDevolucaoEpi" id="formDevolucaoEpi">
                <div class="modal-body">
                    <input type="hidden" name="idEpiDevolucao" id="idEpiDevolucao">
                    <input type="hidden" name="codigoDoEmprestimo" id="codigoDoEmprestimo">
                    <div class="">
                        <p><b>Código do empréstimo:</b> <span id="codigoEmprestimo"></span></p>
                        <p><b>Nome do EPI:</b> <span id="nomeEPI"></span></p>
                    </div>
                    <div class="mt-3">
                        <label for="situacaoEpi">Selecione a condição do EPI</label>
                        <select name="situacaoEpi" id="situacaoEpi" class="form-select">
                            <option value="bomEstado">Bom estado</option>
                            <option value="avariado">Com avarias</option>
                        </select>
                    </div>
                    <div style="display: none" id="casoAvariado">
                        <div class="mt-3">
                            <label for="opcao">Selecione o procedimento necessário</label>
                            <select name="opcao" id="opcao" class="form-select">
                                <option value="">Selecione um opção</option>
                                <option value="2">Reparar EPI</option>
                                <option value="3">Substituir EPI</option>
                            </select>
                            <p class="text-danger text-center" id="errorOpcao" style="display: none;">É necessário
                                escolher uma opção!</p>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="observacaoSobreOEpi"
                                      name="observacaoSobreOEpi"
                                      style="height: 100px">
                            </textarea>
                                <label for="observacaoSobreOEpi">Descreva a situação do EPI</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalDevolucaoEpi">Fechar
                    </button>
                    <button type="submit" class="btn btn-success btn-sm" id="btnDevolverEpi">Devolver</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
        integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs"
        type="module"></script>
<script src="../js/script.js"></script>


</body>

</html>