<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');

if ($_SESSION['idadm']) {
    $idUsuario = $_SESSION['idadm'];
} else {
    session_destroy();
    header('location: index.php?error=404');
}


?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Titulo</title>

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
<?php
include_once('nav.php');

?>
<div class="row">
    <div class="col-2">

    </div>
    <div class="col-10">

    </div>
</div>
<div class="container">
    <div id='show' class='show'>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center align-items-center">


                    <form action="verificarAluguel.php" method="get">
                        <input type="text" id="codigoAluguel" name="codigoAluguel">
                        <button type="submit" class="btn btn-success">Pesquisar EPI</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-4 col-md-4 col-sm-12">

                <div class=" d-flex justify-content-center align-items-center ">
                    <canvas id="myChart"></canvas>
                </div>
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Alugado', 'Não Alugados'],
                            datasets: [{
                                label: 'Número de aluguéis',

                                data: ['235', '532'],

                                backgroundColor: [
                                    'rgba(219,2,2,0.8)',
                                    'rgba(12,148,0, 0.8)'

                                ],
                                borderColor: [
                                    'rgb(2,2,2)',
                                    'rgb(2,2,2)'

                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });


                </script>

            </div>
            <div class="col-4 col-md-4 col-sm-12">
                <?php
                $aray = array();
                $topTotal = array();
                $arayPessoas = array();
                $contarAray = 0;

                $selectAlugadores = listarTabelaInnerJoinOrdenadaLimitada('a.idusuario,nomeUsuario', 'usuario','aluguel','idusuario','idusuario','idusuario','ASC');

                foreach ($selectAlugadores as $itemAlu) {
                    $iduser = $itemAlu->idusuario;
                    $nomeUser = $itemAlu->nomeUsuario;
                    array_push($aray, "$iduser");
                    array_push($arayPessoas, "$nomeUser");
                }

                $aray = array_unique($aray);
                $aray = array_values($aray);
                $arayPessoas = array_unique($arayPessoas);
                $arayPessoas = array_values($arayPessoas);
                echo '<pre>';
                print_r($aray);
                echo '</pre>';


                foreach ($aray as $itemArray) {
                    $id = $itemArray;
                    echo $id.'<br>';

                    $selectTopAluguel = listarItemExpecifico('count(quantidade) as total', 'aluguel', 'idusuario', $id);
            foreach ($selectTopAluguel as $valor){
                $fim = $valor->total;
            }
                array_push($topTotal,"$fim");
                $topTotal = array_values($topTotal);
                $contarAray = $contarAray+1;
                }
                            echo '<pre>';
                            print_r($topTotal);
                            echo '</pre>';
                            $contarPeople= 0;
                            $contarValue= 0;
                ?>
                <div class=" d-flex justify-content-center align-items-center ">
                    <canvas id="myChart2"></canvas>
                </div>

                <script>
                    const ctx2 = document.getElementById('myChart2');
                    new Chart(ctx2, {
                        type: 'doughnut',
                        data: {
                            labels: [
                                <?php
                                foreach ($arayPessoas as $people){
                                    ?>
                                '<?php echo $arayPessoas[$contarPeople];
                                    $contarPeople = $contarPeople+1?>',
                                <?php
                                }
                                ?>
                               ],
                            datasets: [{
                                label: 'Quantidade de Aluguéis feitos',

                                data: [
                                    <?php
                                    foreach ($topTotal as $value){
                                    ?>
                                    '<?php echo $topTotal[$contarValue];
                                        $contarValue = $contarValue+1?>',
                                    <?php
                                    }
                                    ?>
                                ],

                                backgroundColor: [
                                    'rgba(211,50,50,0.8)',
                                    'rgba(255,128,0,0.8)',
                                    'rgba(247,255,0,0.8)',
                                    'rgba(50,211,211,0.8)',
                                    'rgba(17,0,255,0.8)'

                                ],
                                borderColor: [
                                    'rgb(2,2,2)',
                                    'rgb(2,2,2)'

                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>

            </div>
        </div>

        <?php
        //include_once('listarEpi.php');
        ?>
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