<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
$codigoAluguel = filter_input(INPUT_GET, 'codigoAluguel', FILTER_SANITIZE_STRING);

?>


<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluguel - <?php echo $codigoAluguel ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#000000">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
<div class="container overflowTable">

    <h1>Aluguel - #<?php echo $codigoAluguel ?></h1>

    <table class="table table-hover table-bordered border-dark text-center">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Usuário</th>
            <th scope="col">Epi</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Prioridade</th>
            <th scope="col">Data de Inicio</th>
            <th scope="col">Data de Término</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $contar = 1;
        $listaAlguel = listarTabelaInnerJoinTriploOrdenadaExpecifica("*", "aluguel", 'usuario', 'epi', 'idusuario', 'idusuario', 'idepi', 'idepi', 'codigoAluguel', $codigoAluguel, 'dataFim', 'ASC');
        if ($listaAlguel !== 'Vazio') {
            foreach ($listaAlguel as $item) {
                $ativo = $item->ativo;
                if ($ativo === 'A') {

                    $nomeUsuario = $item->nomeUsuario;
                    $idepi = $item->idepi;
                    $nomeEpi = $item->nomeEpi;
                    $quantidade = $item->quantidade;
                    $prioridade = $item->prioridade;
                    $dataInicio = $item->dataInicio;
                    $dataFim = $item->dataFim;


                    ?>
                    <tr>
                        <th scope="row"><?php echo $contar ?></th>
                        <td><?php echo $nomeUsuario ?></td>
                        <td class="tableNaoVazada"><?php echo $nomeEpi ?></td>
                        <td><?php echo $quantidade ?></td>
                        <td><?php echo $prioridade ?></td>
                        <td><?php echo $dataInicio ?></td>
                        <td><?php echo $dataFim ?></td>
                    </tr>
                    <?php
                    ++$contar;
                }
            }
        } else {
            ?>
            <tr>
                <td colspan="7" class="text-center">
                    <h4>Nenhum Aluguel cadastrado no banco</h4>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
<?php
//66845a71e3c4b
$link = "http://localhost/tcc/verificarAluguel.php?codigoAluguel=$codigoAluguel"

?>
<img src="https://api.qrserver.com/v1/create-qr-code/?data=<?php echo $link?>&amp;size=200x200" alt="" title="" />

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