<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
$codigoAluguel = filter_input(INPUT_GET, 'codigoAluguel', FILTER_SANITIZE_STRING);


$link = "http://localhost/tcc/verificarAluguel.php?codigoAluguel=$codigoAluguel"
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluguel - <?php echo $codigoAluguel ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>


<body>
<?php include_once('nav.php') ?>

<div class="container">

    <h1>Aluguel - #<?php echo $codigoAluguel ?></h1>


    <?php

    $listaAlguel = listarTabelaInnerJoinQuadruploWhere('*', 'aluguel', 'usuario', 'produtoAluguel', 'epi', 'idusuario', 'idusuario', 'codigoAluguel', 'codAluguel', 'idepi', 'idepi', 'codAluguel', "$codigoAluguel", 'horaFim', 'DESC');
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
            $dataAluguel = $item->dataAluguel;
            $email = $item->email;


            $dataAluguel = implode("/", array_reverse(explode("-", $dataAluguel)));
        }
    }

    ?>
    <div class="row">
        <div class="col-lg-6 mt-4 d-flex justify-content-center">
            <div class="card" style=" max-width: 250px!important">
                <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $link ?>&amp;size=250x250"
                     class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <p class="card-text"><?php echo $codigoAluguel ?></p>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-4">
            <p>Nome: <?php echo $nomeUsuario ?></p>
            <p>Email: <?php echo $email ?></p>
            <p>Telefone: <?php echo $telefone ?></p>
            <p>Data: <?php echo $dataAluguel ?></p>
            <p>Prioridade: <?php echo $prioridade ?></p>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 class="mt-5 mb-4">Ferramentas emprestadas</h2>
                <div class="owl-carousel owl-theme">
                    <?php
                    print_r($epi);
                    echo $codigoAluguel;
                    echo '<br>';
                    foreach ($epi as $key => $value) {
                        $id = $key;
                        $selectCompras = listarTabelaInnerJoinOrdenadaDuploWhere('*', 'epi', 'produtoaluguel', 'idepi', 'idepi', 'a.idepi', $id, 'b.codAluguel', $codigoAluguel, 'a.idepi', 'ASC');
                        print_r($selectCompras);
                        if ($selectCompras !== 'Vazio') {
                            foreach ($selectCompras as $item) {
                                $nome = $item->nomeEpi;
                                $foto = $item->foto;
                                $CA = $item->certificado;
                                $quantidade = $item->quantidade;

                                ?>

                                <div class="item">
                                    <div class="card mb-3 item">
                                        <div class="row g-0">
                                            <div class="col-4">
                                                <img src="../img/produtos/<?php echo $foto ?>"
                                                     class="img-fluid rounded-start"
                                                     alt="foto do epi: <?php echo $nome ?>">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body">
                                                    <h5 class="card-title tituloCard"><?php echo $nome ?></h5>
                                                    <p class="card-text">Número do CA: <?php echo $CA ?></p>
                                                    <p class="card-text">Quantidade: <?php echo $quantidade ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }

                    }
                    ?>
                </div>

                <?php
                } else {
                    ?>

                    <h4>Nenhum Aluguel cadastrado</h4>
                    <?php
                }
                ?>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js"
            integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
    <script src="../js/script.js"></script>

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
                    500: {
                        items: 2
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