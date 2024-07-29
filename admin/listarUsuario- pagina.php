<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
$listarEmprestimo = 'NAO';

// Definindo o limite e a página atual
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina - 1) * $limit;

// Contar total de registros
$total_registros = contarRegistros('usuario');
$total_paginas = ceil($total_registros / $limit);

// Buscar os registros paginados
$listaUsuario = listarTabelaPaginada('*', 'usuario', $pagina - 1, $limit);
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Adminstrador</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#ffffff">

</head>

<body>
<div id="show">
<?php
include_once('nav.php');

?>

<div class="container">
    <div class="mt-5 d-flex justify-content-between align-items-center">
        <h1 style="margin-top: 20px;margin-bottom: 20px;font-family: Bahnschrift">Usuário(s)</h1>
        <div class="d-flex align-items-center">
            <button class="btn btnAmareloBos mx-1 " onclick="imprimir('Lista de Usuarios do Sistema','tabelaUser')"><i
                        class="bi bi-printer"></i></button>
            <button type="button" class="btn btnDark"
                    onclick="abrirModalUsuario('nao','nao','nao','nao', 'nao','nao','nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'nao','nao', 'modalUsuarioAdd', 'A', 'btnUsuarioAdd', 'addUsuario', 'frmUsuarioAdd')">
                Cadastrar
            </button>
        </div>
    </div>

    <div class="overflowTable" id="tabelaUser">
        <table class="table table-hover table-bordered border-dark rounded-table">
            <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome Completo</th>
                <th scope="col">CPF</th>
                <th scope="col">Cargo</th>
                <th scope="col">Email</th>
                <th scope="col" class="no-print">Ação</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $contar = $offset + 1; // Contador começando no valor do offset + 1
            if ($listaUsuario) {
                foreach ($listaUsuario as $item) {
                    $idusuario = $item->idusuario;
                    $nome = $item->nomeUsuario;
                    $sobrenome = $item->sobrenome;
                    $telefone = $item->numero;
                    $nascimento = $item->nascimento;
                    $cpf = $item->cpf;
                    $cargo = $item->cargo;
                    if ($cargo == 'adm') {
                        $cargo = "Administrador";
                    } else if ($cargo == 'funcionario') {
                        $cargo = 'Funcionário';
                    } else if ($cargo == 'rh') {
                        $cargo = "Recursos Humanos";
                    } else if ($cargo == 'almoxarife') {
                        $cargo = "Almoxarife";
                    } else {
                        $cargo = 'Sem cargo';
                    }
                    $email = $item->email;
                    if ($telefone == '') {
                        $telefone = 'Sem telefone';
                    }
                    ?>
                    <tr>
                        <th scope="row"><?php echo $contar ?></th>
                        <td><?php echo "$nome $sobrenome" ?></td>
                        <td><?php echo $cpf ?></td>
                        <td><?php echo $cargo ?></td>
                        <td><?php echo $email ?></td>
                        <td class="no-print">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-success" style="float: right"
                                        onclick="abrirModalUsuario('nao','nao','nomeUsuarioVermais','<?php echo $nome; ?>', 'sobrenomeUsuarioVermais','<?php echo $sobrenome; ?>','telefoneUsuarioVermais','<?php echo $telefone ?>', 'CPFUsuarioVermais','<?php echo $cpf; ?>', 'nascimentoUsuarioVermais','<?php echo $nascimento; ?>', 'cargoUsuarioVermais','<?php echo $cargo; ?>', 'emailUsuarioVermais','<?php echo $email; ?>', 'nao','nao','modalUsuarioVermais', 'A', 'nao', 'editUsuario', 'frmUsuarioVermais')">
                                    <i class="bi bi-person-lines-fill"></i></button>
                                <?php
                                if ($cargo !== 'almoxarife') {
                                    ?>
                                    <button type="button" class="btn btn-info" style="float: right"
                                            onclick="abrirModalUsuario('idUsuarioEdit','<?php echo $idusuario; ?>','nomeUsuarioEdit','<?php echo $nome; ?>', 'sobrenomeUsuarioEdit','<?php echo $sobrenome; ?>','telefoneUsuarioEdit','<?php echo $telefone ?>', 'CPFUsuarioEdit','<?php echo $cpf; ?>', 'nascimentoUsuarioEdit','<?php echo $nascimento; ?>', 'cargoUsuarioEdit','<?php echo $cargo; ?>', 'emailUsuarioEdit','<?php echo $email; ?>', 'nao','nao','modalUsuarioEdit', 'A', 'btnUsuarioEdit', 'editUsuario', 'frmUsuarioEdit')">
                                        <i class="mdi mdi-file-edit-outline"></i></button>
                                    <button type="button" class="btn btn-danger"
                                            onclick="deleletarUsuario('<?php echo $idusuario; ?>','deleteUsuario')"><i
                                                class="mdi mdi-trash-can"></i></button>
                                    <?php
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                    ++$contar;
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center">
                        <h4>Nenhum Usuário cadastrado no banco</h4>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Botões de paginação -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            <!-- Botão para voltar uma página -->
            <a href="?pagina=<?php echo max($pagina - 1, 1); ?>&limit=<?php echo $limit; ?>" class="btn btn-secondary">Voltar</a>

            <!-- Botão para avançar uma página -->
            <a href="?pagina=<?php echo min($pagina + 1, $total_paginas); ?>&limit=<?php echo $limit; ?>"
               class="btn btn-secondary">Avançar</a>
        </div>

        <div>
            <!-- Botões para definir o limite de registros por página -->
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="?pagina=1&limit=5" class="btn btn-outline-primary">5</a>
                <a href="?pagina=1&limit=10" class="btn btn-outline-primary">10</a>
                <a href="?pagina=1&limit=20" class="btn btn-outline-primary">20</a>
            </div>

        </div>
    </div>

</div>
</div>


<!-- Modal Add Usuario -->
<div class="modal fade" id="modalUsuarioAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioAdd" id="frmUsuarioAdd">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control" id="nomeUsuarioAdd"
                                       name="nomeUsuarioAdd">
                                <span>Nome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control" id="sobrenomeUsuarioAdd"
                                       name="sobrenomeUsuarioAdd">
                                <span>Sobrenome</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control celular"
                                       id="telefoneUsuarioAdd"
                                       name="telefoneUsuarioAdd">
                                <span>Celular</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="text" class="form-control cpf" id="CPFUsuarioAdd"
                                       name="CPFUsuarioAdd">
                                <span>CPF</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="date" class="form-control" id="nascimentoUsuarioAdd"
                                       name="nascimentoUsuarioAdd" value='<?php echo Data18AnosAtras() ?>'>
                                <span>Data de Nascimento</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField2 mb-3">
                                <select required="required" class="form-select" aria-label="Default select example"
                                        id="cargoUsuarioAdd" name="cargoUsuarioAdd">
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option selected value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                                <span>Cargo</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="email" class="form-control" id="emailUsuarioAdd"
                                       name="emailUsuarioAdd">
                                <span>Email de acesso</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input required="required" type="password" class="form-control" id="senhaUsuarioAdd"
                                       name="senhaUsuarioAdd">
                                <span>Senha de acesso</span>
                            </div>
                            <label for="senhaUsuarioAdd"
                                   class="olhinho" id="olhinho" onclick="mostrarsenha('senhaUsuarioAdd')"><span
                                        id="btn-senha" class="bi bi-eye"></span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza   btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalAddUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btnDark btn-sm" id="btnUsuarioAdd">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Usuario -->
<div class="modal fade" id="modalUsuarioEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioEdit" id="frmUsuarioEdit">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="formField d-none mb-3">
                                <input type="text" class="form-control" id="idUsuarioEdit" name="idUsuarioEdit">
                                <label class="input-group-text" for="idUsuarioEdit">id</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="nomeUsuarioEdit" name="nomeUsuarioEdit">
                                <span for="nomeUsuarioEdit">Nome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="sobrenomeUsuarioEdit"
                                       name="sobrenomeUsuarioEdit">
                                <span for="sobrenomeUsuarioEdit">Sobrenome</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control celular" id="telefoneUsuarioEdit"
                                       name="telefoneUsuarioEdit">
                                <span for="telefoneUsuarioEdit" >Celular</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="text" class="form-control cpf" id="CPFUsuarioEdit" name="CPFUsuarioEdit">
                                <span for="CPFUsuarioEdit">CPF</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField mb-3">
                                <input type="date" class="form-control" id="nascimentoUsuarioEdit"
                                       name="nascimentoUsuarioEdit"
                                       value='<?php echo Data18AnosAtras() ?>'>
                                <span for="nascimentoUsuarioEdit">Data de Nascimento</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="formField2 mb-3">
                                <select class="form-select" aria-label="Default select example" id="cargoUsuarioEdit"
                                        name="cargoUsuarioEdit">
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                                <span for="cargoUsuarioEdit">Cargo</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="formField mb-3">
                                <input type="text" class="form-control" id="emailUsuarioEdit" name="emailUsuarioEdit">
                                <span for="emailUsuarioEdit">Email de Acesso</span>
                            </div>
                        </div>

                        <button class="btn btn-info text-white w-100 mb-3" id="btnAlterarSenha" type="button">
                            Alterar senha
                        </button>
                        <button class="btn btn-secondary text-white w-100 mb-3" id="btnFecharAlterarSenha" type="button"
                                style="display: none">
                            Não alterar senha
                        </button>
                        <div id="dNone" style="display: none">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="formField mb-3">
                                        <input type="password" class="form-control" id="novaSenhaUsuarioEdit"
                                               name="novaSenhaUsuarioEdit">
                                        <span for="novaSenhaUsuarioEdit">Digite a nova senha</span>
                                    </div>
                                    <label for="novaSenhaUsuarioEdit" class="olhinho2"  id="btn-senha olhinho2" onclick="mostrarsenha('novaSenhaUsuarioEdit')">
                                        <span class="bi bi-eye"></span>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <div class="formField mb-3">
                                        <input type="password" class="form-control" id="confirmNovaSenhaUsuarioEdit"
                                               name="confirmNovaSenhaUsuarioEdit">
                                        <span for="confirmNovaSenhaUsuarioEdit">Repita a senha</span>
                                    </div>
                                    <label class=" olhinho3" for="confirmNovaSenhaUsuarioEdit" id="btn-senha olhinho3"
                                           onclick="mostrarsenha('confirmNovaSenhaUsuarioEdit')"><span
                                                class="bi bi-eye"></span>
                                    </label>
                                </div>
                            </div>
                            <p class="text-danger text-center" id="alertaSenha" style="display: none"></p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalEditUsuario">Fechar
                    </button>
                    <button type="submit" class="btn btnAzulBostrap btn-sm" id="btnUsuarioEdit">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver MAIS Usuario -->
<div class="modal fade" id="modalUsuarioVermais" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Ver mais</h1>
            </div>
            <form action="#" method="post" name="frmUsuarioVermais" id="frmUsuarioVermais">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label for="input" class="text">Name</label>
                                <input type="text" class="form-control mdlVermaisUsuario input" id="nomeUsuarioVermais"
                                       name="nomeUsuarioVermais" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="sobrenomeUsuarioVermais">Sobrenome</label>
                                <input type="text" class="form-control mdlVermaisUsuario input"
                                       id="sobrenomeUsuarioVermais"
                                       name="sobrenomeUsuarioVermais" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="telefoneUsuarioVermais">Celular</label>
                                <input type="text" class="form-control mdlVermaisUsuario input"
                                       id="telefoneUsuarioVermais"
                                       name="telefoneUsuarioVermais" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="CPFUsuarioVermais">CPF</label>
                                <input type="text" class="form-control mdlVermaisUsuario cpf input"
                                       id="CPFUsuarioVermais"
                                       name="CPFUsuarioVermais" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="nascimentoUsuarioVermais">Data de Nascimento</label>
                                <input type="date" class="form-control mdlVermaisUsuario input"
                                       id="nascimentoUsuarioVermais"
                                       name="nascimentoUsuarioVermais"
                                       value='<?php echo Data18AnosAtras() ?>' disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="coolinput mb-3">
                                <label class="text" for="nomeUsuarioVermais">Cargo</label>
                                <select class="form-select mdlVermaisUsuario select" aria-label="Default select example"
                                        id="cargoUsuarioVermais"
                                        name="cargoUsuarioVermais" disabled>
                                    <option value="adm">Adminstrador</option>
                                    <option value="almoxarife">Almoxarife</option>
                                    <option value="funcionario">Funcionário</option>
                                    <option value="rh">Recursos Humanos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="coolinput mb-3">
                                <label class="text" for="emailUsuarioVermais">Email de acesso</label>
                                <input type="text" class="form-control mdlVermaisUsuario input" id="emailUsuarioVermais"
                                       name="emailUsuarioVermais" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btnCinza btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalVermaisUsuario">Fechar
                    </button>
                </div>
            </form>
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
<script src="../js/script.js"></script>

</body>

</html>