<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

if (isset($_SESSION['idFuncionario']) && !empty($_SESSION['idFuncionario'])) {
    $idFuncionario = $_SESSION['idFuncionario'];
} else {
    $idFuncionario = null;
}

//unset($_SESSION['pedidoscarrinho']);
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrinho</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>
<?php include_once('navbar.php');


?>

<div class="container">
    <?php
    if (isset($_SESSION['pedidoscarrinho']) && !empty($_SESSION['pedidoscarrinho'])) {
        ?>
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mt-3">Itens para empréstimo</h3>
            <button class="btn btn-sm btn-danger" type="button" id="btnLimparCarrinho"
                    onclick="limparCarrinho('apagar')">Limpar carrinho
            </button>
        </div>
        <?php
    }

    ?>
    <div class="row">
        <div class="col-12">
            <?php
            if (!empty($_SESSION['pedidoscarrinho']) && isset($_SESSION['pedidoscarrinho'])) {
                ?>
                <div class="row mt-5" id="listagemCarrinho">
                    <!--A listagem doo carrinho está sendo feita via JS-->
                </div>
                <hr>
                <form action="#" name="frmCarrinho" id="frmCarrinho" method="post">
                    <div class="row mb-5">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="mt-4">
                                <label for="dataAluguel">Selecione a data do aluguel:</label>
                                <input type="date" id="dataAluguel" name="dataAluguel" class="form-control"
                                       value="<?php echo DATAATUAL ?>" required="required">
                                <p id="alertData" style="display: none"></p>
                            </div>
                            <div class="mt-4">
                                <label for="horaInicialAluguel">Selecione a hora de início do aluguel:</label>
                                <select name="horaInicialAluguel" id="horaInicialAluguel" class="form-control"
                                        required="required">
                                    <?php
                                    $minuto = '0';
                                    $hora = 0;
                                    while ($hora < 24) {
                                        if ($hora < 10) {
                                            ?>
                                            <option value="<?php echo '0' . $hora . ':' . $minuto . '0'; ?>"><?php echo '0' . $hora . ':' . $minuto . '0'; ?></option>
                                            <?php

                                        } else {

                                            ?>
                                            <option value="<?php echo $hora . ':' . $minuto . '0'; ?>"><?php echo $hora . ':' . $minuto . '0'; ?></option>
                                            <?php
                                        }

                                        if ($minuto == '0') {
                                            $minuto = '3';
                                        } else {
                                            $minuto = '0';
                                            $hora = $hora + 1;
                                        }
                                    }
                                    ?>
                                </select>
                                <p id="alertHoraInicial" style="display: none"></p>
                            </div>
                            <div class="mt-4">
                                <label for="horaFinalAluguel">Selecione a hora de término do aluguel:</label>
                                <select name="horaFinalAluguel" id="horaFinalAluguel" class="form-control"
                                        required="required">
                                    <?php
                                    $minuto = '0';
                                    $hora = 0;
                                    while ($hora < 24) {
                                        if ($hora < 10) {
                                            ?>
                                            <option value="<?php echo '0' . $hora . ':' . $minuto . '0'; ?>"><?php echo '0' . $hora . ':' . $minuto . '0'; ?></option>
                                            <?php

                                        } else {

                                            ?>
                                            <option value="<?php echo $hora . ':' . $minuto . '0'; ?>"><?php echo $hora . ':' . $minuto . '0'; ?></option>
                                            <?php
                                        }

                                        if ($minuto == '0') {
                                            $minuto = '3';
                                        } else {
                                            $minuto = '0';
                                            $hora = $hora + 1;
                                        }
                                    }
                                    ?>
                                </select>
                                <p id="alertHoraFinal" style="display: none"></p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 ">
                            <div class="mt-4">
                                <label for="addPrioridade" class="label-control">Selecione a prioridade:</label>
                                <select name="addPrioridade" id="addPrioridade" class="form-control"
                                        required="required">
                                    <option value="BAIXA" selected>Baixa</option>
                                    <option value="MEDIA">Média</option>
                                    <option value="ALTA">Alta</option>
                                </select>
                            </div>
                            <div class="input-group mt-4">
                                <span class="input-group-text">Observação</span>
                                <textarea class="form-control" aria-label="With textarea" name="addObservacao"
                                          id="addObservacao"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-center mt-4">
                                <?php
                                if (isset($_SESSION['idFuncionario'])) {
                                    ?>
                                    <button class="btn btn-success btn-sm btnConcluirAluguel" id="btnConcluirAluguel"
                                            type="submit"
                                            name="btnConcluirAluguel"
                                            onclick="realizarAluguel('frmCarrinho','addAluguel','btnConcluirAluguel')">
                                        Concluir aluguel
                                    </button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-success btn-sm btnConcluirAluguel" id="btnConcluirLogin"
                                            type="button"
                                            name="btnLogin" onclick="redireciona('fazer-login')">
                                        Concluir aluguel
                                    </button>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </form>
                <?php
            } else {
                ?>
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <dotlottie-player src="https://lottie.host/f626c217-5dd4-4bd3-8bba-b85b46b06cb5/h13sx3Lc2a.json"
                                      background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                                      autoplay></dotlottie-player>
                    <p class="fs-1">O seu carrinho está vazio!</p>
                </div>
                <?php
            }

            ?>

        </
        >
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
<script src="./js/script.js"></script>
</body>

</html>