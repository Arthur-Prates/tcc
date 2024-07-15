
<nav class="navbar navbar-expand-lg cinza">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#"><b>SAFETECH</b></a>
        <!--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"-->
        <!--                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
        <!--            <span class="navbar-toggler-icon"></span>-->
        <!--        </button>-->
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
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" onclick="carregarConteudo('listarEpi')">EPI'S</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"
                                   onclick="carregarConteudo('listarAluguel')">Aluguel</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"
                                   onclick="carregarConteudo('listarUsuario')">Usuário</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <a href="logout.php" class="btn btn-sm btn-danger margemEntreSacolaEForm">
                <i class="bi bi-door-open"></i> Sair
            </a>


            <!--                <form action="verificarAluguel.php" method="get" class="d-flex" role="search">-->
            <!--                    <input class="form-control me-2 cinza" type="text" id="codigoAluguel" name="codigoAluguel"  placeholder="Buscar">-->
            <!--                    <button  class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>-->
            <!--                </form>-->
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
            <button class="btnMenuNavbarSMAdmin" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample"
                    aria-expanded="false" aria-controls="collapseExample">
                <i class="bi bi-list-nested"></i> Menu
            </button>

            <div class="collapse" id="collapseExample">
                <div class="card card-body cardNavbarAdminSm">
                    <a class="linkNavbarAdminSM" href="#" onclick="carregarConteudo('listarEpi')">EPI'S</a>
                    <hr>
                    <a class="linkNavbarAdminSM" href="#" onclick="carregarConteudo('listarAluguel')">Aluguel</a>
                    <hr>
                    <a class="linkNavbarAdminSM" href="#" onclick="carregarConteudo('listarUsuario')">Usuário</a>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>