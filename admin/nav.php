<?php
$idFuncionario = $_SESSION['idadm'];
?>
<nav class="navbar fixed-top navbar-expand-lg cinza">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="dashboard.php"><b>SAFETECH</b></a>
        <div class="navbar-toggler">
            <a href="logout.php" class="btn btn-sm btn-danger margemEntreSacolaEForm">
                <i class="bi bi-door-open"></i> Sair
            </a>
            <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="dashboard.php">Home</a>
                </li>
                <?php
                if ($listarEmprestimo !== 'SIM') {
                    ?>
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu">
                            <?php
                            $verificarCargo = listarItemExpecifico('*', 'usuario', 'idusuario', $idFuncionario);
                            if ($verificarCargo !== 'Vazio') {
                                foreach ($verificarCargo as $verificacao) {
                                    $cargo = $verificacao->cargo;

                                    if ($cargo == 'almoxarife' || $cargo == 'adm') {
                                        ?>
                                        <li>
                                            <button class="dropdown-item" onclick="carregarConteudo('listarEpi')">
                                                EPI'S
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button class="dropdown-item" onclick="carregarConteudo('listarAluguel')">
                                                Empréstimos
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <button class="dropdown-item" onclick="carregarConteudo('listarEstoque')">
                                                Estoque
                                            </button>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <?php
                                    }
                                }
                            }
                            ?>

                            <li>
                                <button class="dropdown-item" onclick="carregarConteudo('listarUsuario')">
                                    Usuário
                                </button>
                            </li>

                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <a href="logout.php" class="btn btn-sm btn-danger btnVermelho margemEntreSacolaEForm">
                <i class="bi bi-door-open"></i> Sair
            </a>
        </div>
    </div>
</nav>


<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">SAFETECH - Área restrita</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <a class="nav-link active" href="dashboard.php">Home</a>
        <hr>
        <?php
        if ($listarEmprestimo !== 'SIM') {
            ?>
            <div class="collapse" id="collapseExample">
                <div class="card card-body cardNavbarAdminSm">
                    <button class="linkNavbarAdminSM" onclick="carregarConteudo('listarEpi')">EPI'S</button>
                    <hr>
                    <button class="linkNavbarAdminSM" onclick="carregarConteudo('listarAluguel')">Empréstimos</button>
                    <hr>
                    <button class="linkNavbarAdminSM" onclick="carregarConteudo('listarUsuario')">Usuários</button>
                    <hr>
                    <button class="linkNavbarAdminSM" onclick="carregarConteudo('listarEstoque')">Estoque</button>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>