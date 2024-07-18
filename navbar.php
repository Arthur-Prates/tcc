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

<nav class="navbar navbar-expand-lg cinza" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="pagina-inicial">SAFETECH</a>
        <div class="navbar-toggler">
            <a href="carrinho" class="text-decoration-none text-white margemEntreSacolaEForm">

                <i class="bi bi-cart4 fs-5"></i><span> </span><sup class="qtdDeItensNoCarrinho "
                                                                   id="qtdDeItensNoCarrinho1">
                    <?php
                    if (isset($_SESSION['pedidoscarrinho'])) {
                        $cont = count($_SESSION['pedidoscarrinho']);
                    } else {
                        $cont = 0;
                    }
                    echo $cont;
                    ?>
                </sup>
            </a>
            <button class="navbar-toggler btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="pagina-inicial">Início</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <span class="mdi mdi-account-circle-outline"></span> Menu
                    </a>
                    <?php
                    if ($idFuncionario == null) {
                        ?>
                        <ul class="dropdown-menu ">
                            <li class=""><a class="dropdown-item" href="fazer-login">Fazer login</a></li>
                        </ul>

                        <?php
                    } else {
                        ?>
                        <ul class="dropdown-menu ">
                            <li class=""><a class="dropdown-item" href="meu-perfil">Meu perfil</a></li>
                            <li class=""><a class="dropdown-item" href="meus-alugueis">Meus aluguéis</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout">Sair</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <a href="carrinho" class="text-decoration-none text-white margemEntreSacolaEForm">

                <i class="bi bi-cart4 fs-5"></i>
                <span> Carrinho</span><sup class="qtdDeItensNoCarrinho" id="qtdDeItensNoCarrinho2">
                    <?php
                    if (isset($_SESSION['pedidoscarrinho'])) {
                        $cont = count($_SESSION['pedidoscarrinho']);
                    } else {
                        $cont = 0;
                    }
                    echo $cont;
                    ?>
                </sup>
            </a>
            <form action="resultado-da-busca" method="get" name="pesquisaNavbarLG" class="d-flex" role="search">
                <input class="form-control me-2" id="pesquisa" name="pesquisa" type="search" placeholder="Pesquisar EPI" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header cinza">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">SAFETECH</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div>
            <form action="resultado-da-busca" method="get"  name="pesquisaNavbarSM" class="d-flex" role="search">
                <input class="form-control me-2" id="pesquisaSM" name="pesquisa" type="search" placeholder="Pesquisar EPI" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <hr>
        <div class="" id="">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="pagina-inicial">Início</a>
                </li>
                <hr>
                <li class="nav-item dropdown">
                    <button class="btnMenuNavbarSM" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <span class="mdi mdi-account-circle-outline"></span> Menu
                    </button>
                    <?php
                    if ($idFuncionario == null) {
                        ?>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body cardNavbarSM">
                                <a class="linkNavbarSM" href="fazer-login">Fazer login</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body cardNavbarSM">
                                <a class="linkNavbarSM" href="meu-perfil">Meu perfil</a>
                                <hr>
                                <a class="linkNavbarSM" href="meus-alugueis">Meus aluguéis</a>
                                <hr>
                                <a class="linkNavbarSM" href="logout">Sair</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <hr>


        </div>
    </div>
</div>