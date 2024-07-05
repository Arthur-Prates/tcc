<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

if (!empty($_SESSION['idFuncionario'])) {
    $idFuncionario = $_SESSION['idFuncionario'];

} else {
    $idFuncionario = null;
}

$codigoAluguel = filter_input(INPUT_POST, 'idCodAluguel', FILTER_SANITIZE_STRING);

$link = "http://localhost/tcc/verificarAluguel.php?codigoAluguel=$codigoAluguel";
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar carrinho</title>

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
<?php include_once('navbar.php') ?>


<div class="container">
    <div class="row">
        <div class="col-lg-12 fs-2">
            <a href="aluguel.php" class="btn btn-sm btn-outline-secondary">Voltar</a>
            Empréstimo - #<?php echo $codigoAluguel ?>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-5 text-center">
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $link ?>&amp;size=300x300" alt=""
                 title=""/>
        </div>
        <div class="col-lg-7">
            <?php
            $tabelaAluguel = listarTabelaInnerJoinTriploOrdenadaExpecifica('*', 'aluguel', 'epi', 'usuario', 'idepi', 'idepi', 'idusuario', 'idusuario', 'codigoAluguel', $codigoAluguel, 'idaluguel', 'ASC');
            if ($tabelaAluguel !== 'vazio') {
                foreach ($tabelaAluguel as $item) {
                    $dataAluguel = $item->dataAluguel;
                    $horaInicial = $item->horaInicial;
                    $horaFinal = $item->horaFinal;
                    $locatario = $item->nomeUsuario;
                    $email = $item->email;
                    $prioridade = $item->prioridade;
                    $observacao = $item -> observacao;

                    $dataAluguel = implode("/", array_reverse(explode("-", $dataAluguel)));


                    if ($prioridade == 'ALTA') {
                        $prioridade = 'Alta';
                    } else if ($prioridade == 'MEDIA') {
                        $prioridade = 'Média';
                    } else {
                        $prioridade = 'Baixa';
                    }

                }
                ?>
                <p class="mt-4">Locatário: <?php echo $locatario ?></p>
                <p>Email: <?php echo $email ?></p>
                <p>Data do aluguel: <?php echo $dataAluguel ?></p>
                <p>Hora inicial do aluguel: <?php echo $horaInicial ?></p>
                <p>Hora final do aluguel: <?php echo $horaFinal ?></p>
                <p>Nível de prioridade: <?php echo $prioridade ?></p>
                <p>Observação: <?php echo $observacao ?></p>
                <?php
            } else {
                ?>
                <div class="text-center">
                    <h1>Nenhum EPI encontrado!</h1>
                </div>
                <?php
            }

            ?>
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
</body>

</html>