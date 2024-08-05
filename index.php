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
    <title>Área Principal - Safetech</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon/4.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#90bae0">

</head>
<body>
<?php include_once('navbar.php') ?>
<div class="container mt-4 mb-5">
    <div class="row mt-5 justify-content-md-center">
        <?php
        $tabelaProdutos = listarTabelaInnerJoinOrdenada('*', 'epi', 'estoque', 'idepi', 'idepi', 'a.idepi', 'ASC');
        foreach ($tabelaProdutos as $item) {
            $nome = $item->nomeEpi;
            $certificado = $item->certificado;
            $foto = $item->foto;
            $id = $item->idepi;
            $estoque = $item->disponivel;

            if ($estoque > 0) {

                ?>
                <div class="col-6 col-md-6 col-lg-3 col-xl-3 mt-4">
                    <div class="card rounded-4">
                        <div class="imgProduto">
                            <img src="./img/produtos/<?php echo $foto ?>" class="card-img-top p-2" alt="<?php echo $nome ?>"  title="<?php echo $nome ?>">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title nomeProduto"><?php echo $nome ?></h4>
                        </div>
                        <div style='margin-left: 15px;'>
                            <h6 class="">Nº CA: <?php echo $certificado ?></h6>
                            <h6 class="text-secondary">Quantidade disponível: <?php echo $estoque ?></h6>
                        </div>
                        <div class="card-body text-center">
                            <button class="btn btn-sm btnVerdePoucoNeon rounded-4" onclick="postCarrinho(<?php echo $id ?>)">Adicionar
                            </button>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <button onclick="voltarAoTopo()" id="btnTopo" class="btnTopo" title="Voltar ao Topo"><i class="bi bi-arrow-up-short"></i></button>
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
<script src="./js/fetchcarrinho.js"></script>

</body>

</html>