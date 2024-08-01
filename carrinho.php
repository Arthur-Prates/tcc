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
    <link rel="stylesheet" href="./css/teste.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon/2.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
<?php include_once('navbar.php');


?>

<div class="container">
    <div class="card rounded-4 cardCarrinho">
        <div class="card-body cardBodyCarrinho">
            <?php
            if (isset($_SESSION['pedidoscarrinho']) && !empty($_SESSION['pedidoscarrinho'])) {
                ?>
                <div class="d-flex justify-content-between align-items-center">
                    <h2 class="mt-2"><b>Itens para Empréstimo</b></h2>


                    <button class="CartBtn py-4" type="button" id="btnLimparCarrinho"
                            onclick="limparCarrinho('apagar')">
  <span class="IconContainer">
    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="white" class="cart"><path
                d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
  </span>
                        <p class="text mt-3">Limpar carrinho</p>
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
                        <div class="row mt-5 rowCarrinho" id="listagemCarrinho">
                            <!--A listagem doo carrinho está sendo feita via JS-->
                        </div>
                        <hr>
                        <form action="#" name="frmCarrinho" id="frmCarrinho" method="post">
                            <div class="row mb-5  ">

                                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center">
                                    <div>
                                        <div class="mt-4">
                                            <label for="dataAluguel">Selecione a data do empréstimo:</label>
                                            <input type="date" id="dataAluguel" name="dataAluguel"
                                                   class="form-control inputCarrinho"
                                                   value="2024-08-08" required="required" autocomplete="off">
                                            <p id="alertData" style="display: none"></p>
                                        </div>

                                        <div class="mt-4">
                                            <label for="horaInicialAluguel">Selecione a hora de início do
                                                empréstimo:</label>
                                            <select name="horaInicialAluguel" id="horaInicialAluguel" autocomplete="off"
                                                    class="form-control inputCarrinho"
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
                                            <label for="horaFinalAluguel">Selecione a hora de término do
                                                empréstimo:</label>
                                            <select name="horaFinalAluguel" id="horaFinalAluguel" autocomplete="off"
                                                    class="form-control inputCarrinho"
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
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 d-flex justify-content-center">
                                    <div>
                                        <div class="mt-4">
                                            <label for="addPrioridade" class="label-control">Selecione aqui a prioridade
                                                do empréstimo:</label>
                                            <select name="addPrioridade" id="addPrioridade" autocomplete="off"
                                                    class="form-control inputCarrinho"
                                                    required="required">
                                                <option value="1" selected>Baixa</option>
                                                <option value="2">Média</option>
                                                <option value="3">Alta</option>
                                            </select>
                                        </div>
                                        <div class=" mt-4">
                                            <span class="">Observação:</span>
                                            <textarea class="form-control inputCarrinho" aria-label="With textarea"
                                                      name="addObservacao "
                                                      id="addObservacao"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-sm-12 ">
                                    <div class="text-center mt-4">
                                        <?php
                                        if (isset($_SESSION['idFuncionario'])) {
                                            ?>
                                            <button class="btn btn-success btn-sm btnConcluirAluguel"
                                                    id="btnConcluirAluguel"
                                                    type="submit"
                                                    name="btnConcluirAluguel"
                                                    onclick="realizarAluguel('frmCarrinho','addAluguel','btnConcluirAluguel')">
                                                <span> Concluir empréstimo </span>
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-success btn-sm btnConcluirAluguel "
                                                    id="btnConcluirLogin"
                                                    type="button"
                                                    name="btnLogin" onclick="redireciona('fazer-login')">
                                                <span>  Concluir empréstimo </span>
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
                            <dotlottie-player src="./img/carrinhoVazio.json"
                                              background="transparent" speed="1" style="width: 300px; height: 300px;"
                                              loop
                                              autoplay></dotlottie-player>
                            <p class="fs-1">O seu carrinho está vazio!</p>
                        </div>
                        <?php
                    }

                    ?>
                </div>
            </div>
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
<script src="./js/script.js"></script>
<script src="./js/fetchcarrinho.js"></script>

</body>

</html>