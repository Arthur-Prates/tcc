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
        <a class="navbar-brand" href="index.php">SAFETECH</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Início</a>
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
                            <li class=""><a class="dropdown-item" href="logar.php">Fazer login</a></li>
                        </ul>

                        <?php
                    } else {
                        ?>
                        <ul class="dropdown-menu ">
                            <li class=""><a class="dropdown-item" href="#">Meu perfil</a></li>
                            <li class=""><a class="dropdown-item" href="#">Meus aluguéis</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Sair</a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </li>
            </ul>
            <a href="carrinho.php" class="text-decoration-none text-white margemEntreSacolaEForm">

                <i class="bi bi-cart4 fs-5"></i><span> Carrinho</span><sup class="qtdDeItensNoCarrinho">
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
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Pesquisar EPI" aria-label="Search">
                <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</nav>
