<nav class="navbar navbar-expand-lg cinza">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#"><b>SAFETECH</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-white" aria-current="page" href="#">Home</a>
        </li>
    
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Menu
          </a>
          <ul class="dropdown-menu ">
            <li><a class="dropdown-item" href="#" onclick="carregarConteudo('listarEpi')">EPI'S</a></li>
              <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="carregarConteudo('listarAluguel')">Aluguel</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="carregarConteudo('listarUsuario')">Usuário</a></li>
          </ul>
        </li>
       
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2 cinza" type="search" placeholder="Buscar" aria-label="Search">
        <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
      </form>
    </div>
  </div>
</nav>