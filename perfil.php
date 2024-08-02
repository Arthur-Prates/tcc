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
    <title>Meu perfil</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/png" sizes="16x16"  href="./img/favicon/2.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<?php include_once('navbar.php') ?>

<div class="container">
    <h3 class="mt-4">Informações pessoais</h3>
    <?php
    $tabelaFuncionario = listarItemExpecifico('*', 'usuario', 'idusuario', "$idFuncionario");
    if ($tabelaFuncionario !== 'Vazio') {
        foreach ($tabelaFuncionario as $item) {
            $nome = $item->nomeUsuario;
            $sobrenome = $item->sobrenome;
            $cpf = $item->cpf;
            $nascimento = $item->nascimento;
            $email = $item->email;
            $telefone = $item->numero;
            $matricula = $item->matricula;
            $cargo = $item->cargo;

            if ($telefone == '') {
                $telefone = 'Nenhum telefone cadastrado!';
            }

            if ($cargo == 'funcionario') {
                $cargo = 'Funcionário';
            } else if ($cargo == 'adm') {
                $cargo = 'Administrador';
            } else if ($cargo == 'rh') {
                $cargo = 'Recursos Humanos';
            } else if ($cargo == 'adm') {
                $cargo = 'Administrador';
            }


            $dataNascimento = implode("/", array_reverse(explode("-", $nascimento)));

            ?>


            <div class="row">
                <div class="col-lg-4 col-md-4 col-6 mt-3">
                    <p><b>Nome:</b></p>
                    <p><?php echo $nome . ' ' . $sobrenome ?></p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mt-3">
                    <p><b>CPF:</b></p>
                    <p><?php echo $cpf ?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-6 mt-3">
                    <p><b>Nascimento:</b></p>
                    <p><?php echo $dataNascimento ?></p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 mt-3">
                    <p><b>Telefone:</b></p>
                    <p><?php echo $telefone ?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-3">
                    <p><b>Email:</b></p>
                    <p><?php echo $email ?></p>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-3">
                    <button class="btn btn-sm bg-primary-subtle"
                            onclick="abrirModalAlterarDados('mdlAlterarDados','A','btnAlterarDados','editDados','frmAlterarDados')">
                        Alterar contatos
                    </button>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            onclick="abrirModalAlterarSenha('mdlAlterarSenha','A','btnAlterarSenha','editSenha','frmAlterarSenha')">
                        Alterar senha
                    </button>
                </div>
            </div>
            <hr>
            <h3 class="mt-3">Informações de funcionário</h3>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 mt-3">
                    <p><b>Matrícula:</b></p>
                    <p><?php echo $matricula ?></p>
                </div>
                <div class="col-lg-3 col-md-6 col-12 mt-3">
                    <p><b>Cargo:</b></p>
                    <p><?php echo $cargo ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo 'erro';
    }
    ?>
    <button onclick="voltarAoTopo()" id="btnTopo" class="btnTopo" title="Voltar ao Topo"><i class="bi bi-arrow-up-short"></i></button>
</div>

<!-- Modal editar senha -->
<div class="modal fade" id="mdlAlterarSenha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="#" method="post" name="frmAlterarSenha" id="frmAlterarSenha">
                <div class="modal-body">

                    <div class="card-body">
                        <h3 class="mb-5">Alterar senha</h3>
                        <div class="">
                            <label for="inpAlterarSenha" class="label-control">Digite sua nova senha:</label>
                            <input type="password" name="inpAlterarSenha" id="inpAlterarSenha" class="inpAlterarSenha"
                                   required="required">
                        </div>
                        <div class="mt-4">
                            <label for="confirmarAlteracaoDaSenha" class="label-control">
                                Digite a senha novamente:
                            </label>
                            <input type="password" name="confirmarAlteracaoDaSenha" id="confirmarAlteracaoDaSenha"
                                   class="inpAlterarSenha" required="required">
                        </div>
                    </div>
                    <div class="alert alert-danger" id="alertSenha" style="display: none">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalSenha">Fechar
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" id="btnAlterarSenha">Alterar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal editar email e telefone-->
<div class="modal fade" id="mdlAlterarDados" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="#" method="post" name="frmAlterarDados" id="frmAlterarDados">
                <div class="modal-body">

                    <div class="card-body mb-4">
                        <h3 class="mb-5">Editar informações de contato</h3>
                        <div class="">
                            <label for="inpAlterarEmail" class="label-control">Email:</label>
                            <input type="email" name="inpAlterarEmail" id="inpAlterarEmail" class="inpAlterarSenha">
                        </div>
                        <div class="mt-4">
                            <label for="inpAlterarTelefone" class="label-control">
                                Número de telefone:
                            </label>
                            <input type="text" name="inpAlterarTelefone" id="inpAlterarTelefone"
                                   class="inpAlterarSenha celular">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            id="btnFecharModalDados">Fechar
                    </button>
                    <button class="btn btn-sm btn-primary" type="submit" id="btnAlterarDados">Alterar</button>
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
<script src="./js/script.js"></script>
</body>

</html>