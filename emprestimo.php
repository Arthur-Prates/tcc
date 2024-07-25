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
<!--<form action="verificarAluguel.php" method="get">-->
<!--    <input type="text" id="codigoAluguel" name="codigoAluguel">-->
<!--    <button type="submit">dasd</button>-->
<!--</form>-->

<!--66844c87dab1e-->
<!--66844c73924e1-->
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAFETECH</title>

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
<?php include_once('navbar.php') ?>

<div class="container">
    <h2 class="mt-3">
        <a href="pagina-inicial" class="btn btn-sm btn-outline-secondary">Voltar</a>
        Empréstimos</h2>
    <div class="card mt-3">
        <div class="card-body overflowTable">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Código do empréstimo</th>
                    <th scope="col">Data do empréstimo</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $cont = 1;
                $emprestimos = listarItemExpecificoOrdem('*', 'emprestimo', 'idusuario', "$idFuncionario", 'idemprestimo', 'DESC');
                if ($emprestimos !== 'vazio') {
                    foreach ($emprestimos as $emprestimo) {
                        $id = $emprestimo->idemprestimo;
                        $codigoEmprestimo = $emprestimo->codigoEmprestimo;
                        $dataEmprestimo = $emprestimo->dataEmprestimo;
                        $devolvido = $emprestimo->devolvido;

                        $dataEmprestimo = implode("/", array_reverse(explode("-", $dataEmprestimo)));
                        ?>
                        <tr>
                            <th scope="row"><?php echo $cont ?></th>
                            <td><?php echo $codigoEmprestimo ?></td>
                            <td><?php echo $dataEmprestimo ?></td>
                            <td class="d-flex">
                                <form action="visualizar-emprestimo" name="frmCodAluguel" id="frmCodAluguel"
                                      method="post">
                                    <input type="hidden" id="idCodAluguel" name="idCodAluguel"
                                           value="<?php echo $codigoEmprestimo ?>">
                                    <button class="btn btn-success btn-sm">Visualizar</button>
                                </form>
                                <?php
                                $dataAtual = DATAATUAL;
                                if ($devolvido !== 'S') {
                                    ?>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#erroExcluir">
                                        Excluir
                                    </button>
                                    <?php
                                } else {
                                    ?>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            onclick="abrirModalJsExcluirAluguel('<?php echo $id ?>', 'idDeleteAluguel', 'nao', 'nao', 'mdlExcluirAluguel', 'nao', 'A', 'btnExcluirAluguel', 'deletarAluguel', 'nao', 'nao', 'frmDeleteAluguel')">
                                        Excluir
                                    </button>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        ++$cont;
                    }
                }else{
                    ?>
                    <tr>
                        <td colspan="4" class="text-center">Nenhum empréstimo para ser mostrado!</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal alerta -->
<div class="modal fade" id="erroExcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Problemas ao excluir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h4>Você <b>não</b> pode excluir um empréstimo com devolução pendente</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="mdlExcluirAluguel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Excluir aluguel</h1>
            </div>
            <form action="#" id="frmDeleteAluguel" name="frmDeleteAluguel">
                <div class="modal-body">
                    <input type="hidden" id="idDeleteAluguel" name="idDeleteAluguel">
                    <div class="alert alert-danger">
                        Você tem certeza que deseja excluir esse empréstimo?
                        <h5>Essa ação não pode ser desfeita!</h5>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="btnMdlExcluirAluguel">
                        Fechar
                    </button>
                    <button type="submit" class="btn btn-danger" id="btnExcluirAluguel">Excluir</button>
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
