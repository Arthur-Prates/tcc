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

$cod = listarItemExpecifico('*', 'aluguel', 'codigoAluguel', $codigoAluguel);
foreach ($cod as $itemCod) {
    $codAluguel = $itemCod->codigoAluguel;
    if ($codAluguel) {
        $link = "http://localhost/tcc/verificarAluguel.php?codigoAluguel=$codigoAluguel";
    } else {
        echo '';
    }
}

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
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
        <div class="col-lg-5 col-12 text-center">
            <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $link ?>&amp;size=100%" alt=""
                 title=""/>
        </div>
        <div class="col-lg-7 col-12">
            <?php
            $tabelaAluguel = executaQuery("SELECT * FROM aluguel a INNER JOIN usuario u ON a.idusuario = u.idusuario INNER JOIN produtoAluguel pa ON a.codigoAluguel = pa.codAluguel INNER JOIN epi e ON e.idepi = pa.idepi");
            if ($tabelaAluguel !== 'vazio') {
                foreach ($tabelaAluguel as $item) {
                    $locatario = $item->nomeUsuario;
                    $email = $item->email;
                    $cpf = $item->cpf;
                    $dataAluguel = $item->dataAluguel;
                    $horaInicial = $item->horaInicial;
                    $horaFinal = $item->horaFim;
                    $prioridade = $item->prioridade;
                    $observacao = $item->observacao;

                    $dataAluguel = implode("/", array_reverse(explode("-", $dataAluguel)));

                    if ($observacao == 'NAO') {
                        $observacao = 'Nenhuma observação foi feita';
                    }

                    if ($prioridade == 'ALTA') {
                        $prioridade = 'Alta';
                    } else if ($prioridade == 'MEDIA') {
                        $prioridade = 'Média';
                    } else {
                        $prioridade = 'Baixa';
                    }

                }
                ?>
                <p class="mt-3">Locatário: <?php echo $locatario ?></p>
                <p>Email: <?php echo $email ?></p>
                <p>CPF: <?php echo $cpf ?></p>
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
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="owl-carousel owl-theme">
                <?php
                if ($tabelaAluguel !== 'Vazio') {
                    foreach ($tabelaAluguel as $item) {
                        $nomeEpi = $item->nomeEpi;
                        $codEpi = $item->certificado;
                        $foto = $item->foto;

                        ?>
                        <div class="item d-flex justify-content-center align-items-center">
                            <div class="card mb-3 item cardCarrosselVisualizarAluguel">
                                <div class="row g-0">
                                    <div class="col-lg-4">
                                        <img src="./img/produtos/<?php echo $foto ?>" class="img-fluid rounded-start"
                                             alt="foto do epi: <?php echo $nomeEpi ?>">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $nomeEpi ?></h5>
                                            <p class="card-text">Número do CA: <?php echo $codEpi ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
<script src="./js/script.js"></script>

<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: false,
            navText: ['Voltar', 'Próximo'],
            center: false,
            nav: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        });

    });
</script>
</body>

</html>