<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

if (!empty($_GET['pesquisa']) && isset($_GET['pesquisa'])) {
    $pesquisa = $_GET['pesquisa'];

    if (isset($pesquisa) && !empty($pesquisa)) {
        $resultadoPesquisa = pesquisaLike('*', 'epi', 'nomeEpi', $pesquisa);
        if ($resultadoPesquisa == 'Vazio') {
            $resultadoPesquisa = pesquisaLike('*', 'epi', 'certificado', $pesquisa);
        }
    } else {
        $resultadoPesquisa = 'Vazio';
    }

} else {
    $resultadoPesquisa = 'Vazio';
}



?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" sizes="16x16"  href="./img/favicon/4.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

</head>
<body>
<?php include_once('navbar.php') ?>
<div class="container">
    <?php
    if ($resultadoPesquisa !== 'Vazio') {
        ?>
        <div class="mt-4">
            <h4>Exibindo resultado(s) da busca por: <?php echo $pesquisa ?></h4>
        </div>
        <div class="row">
            <?php
            if ($resultadoPesquisa != 'Vazio') {
                foreach ($resultadoPesquisa as $resultado) {
                    $nomeEpi = $resultado->nomeEpi;
                    $certificado = $resultado->certificado;
                    $foto = $resultado->foto;
                    $idEpi = $resultado->idepi;

                    $tabelaEstoque = listarItemExpecifico('*', 'estoque', 'idepi', $idEpi);
                    foreach ($tabelaEstoque as $estoque) {
                        $qtdDisponivel = $estoque->disponivel;
                        ?>
                        <div class="col-md-6 col-12">
                            <div class="card mb-3 mt-3">
                                <div class="row g-0">
                                    <div class="col-4">
                                        <img src="./img/produtos/<?php echo $foto ?>" class="img-fluid rounded-start"
                                             alt="...">
                                    </div>
                                    <div class="col-8">
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $nomeEpi ?></h4>
                                            <hr>
                                            <p class="card-text"><b>Certificado de
                                                    Aprovação:</b> <?php echo $certificado ?>
                                            </p>
                                            <hr>
                                            <p class="card-text"><b>Quantidade
                                                    disponível:</b> <?php echo $qtdDisponivel ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-sm btn-success w-100"
                                                onclick="postCarrinho(<?php echo $idEpi ?>)">
                                            Adicionar
                                            ao carrinho
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="d-flex justify-content-center align-items-center">
            <dotlottie-player src="./img/animacao-busca-vazia.lottie"
                              background="transparent" speed="1" style="width: 300px; height: 300px;" loop
                              autoplay></dotlottie-player>
            <p class="fs-3">Nenhum resultado foi encontrado, tente novamente!</p>
        </div>

        <?php
    }
    ?>

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