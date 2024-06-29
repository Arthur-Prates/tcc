<?php
include_once('./config/conexao.php');
include_once('./config/constantes.php');
include_once('./func/funcoes.php');

if (!empty($_SESSION['idFuncionario'])) {
    $idFuncionario = $_SESSION['idFuncionario'];

} else {
    $idFuncionario = null;
}


?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titulo</title>

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
<nav class="navbar navbar-expand-lg cinza" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">SAFETECH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <span class="mdi mdi-account-circle-outline"></span>
                    </a>
                    <?php
                    if ($idFuncionario == null) {
                        ?>
                        <ul class="dropdown-menu ">
                            <li class=""><a class="dropdown-item" href="#">Fazer login</a></li>
                        </ul>

                        <?php
                    } else {
                        ?>
                        <ul class="dropdown-menu ">
                            <li class=""><a class="dropdown-item" href="#">Meu perfil</a></li>
                            <li class=""><a class="dropdown-item" href="#">Meus aluguéis</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Pesquisar EPI" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-6 col-md-6 col-lg-3 col-xl-3 mt-4 ">
            <div class="card">
                <img src="./img/produtos/capacete-classe-a.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title nomeProduto">Capacete classe A</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nº CA: 45414</li>
                </ul>
                <div class="card-body text-center">
                    <button class="btn btn-sm btn-success">Adicionar a sacola</button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3 col-xl-3 mt-4 ">
            <div class="card">
                <img src="./img/produtos/luva-de-seguranca.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title nomeProduto">Luva de segurança</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nº CA: 40174</li>
                </ul>
                <div class="card-body text-center">
                    <button class="btn btn-sm btn-success">Adicionar a sacola</button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3 col-xl-3 mt-4 ">
            <div class="card">
                <img src="./img/produtos/cinturao-tipo-paraquedista.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title nomeProduto">Cinturão tipo paraquedista</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nº CA: 46159</li>
                </ul>
                <div class="card-body text-center">
                    <button class="btn btn-sm btn-success">Adicionar a sacola</button>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-6 col-lg-3 col-xl-3 mt-4 ">
            <div class="card">
                <img src="./img/produtos/sapato-sem-cadarco.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title nomeProduto">Sapato de segurança</h5>
                    <p class="card-text"></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nº CA: 44350</li>
                </ul>
                <div class="card-body text-center">
                    <button class="btn btn-sm btn-success">Adicionar a sacola</button>
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
</body>

</html>