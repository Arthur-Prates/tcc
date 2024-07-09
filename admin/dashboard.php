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
            <div class="col-12 ">
                <div class="d-flex justify-content-center align-items-center dashAdm">

                    <form action="verificarAluguel.php" method="get" >
                        <label for="codigoAluguel" class="form-label">Código da Reserva:</label>
                        <input type="text" class="form-control" id="codigoAluguel" name="codigoAluguel" placeholder="Código">
                        <span class="input-group-text">   <button type="submit" class="btn btn-inputAluguel">Pesquisar Aluguel</button></span>
                        
                    </form>

                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-between align-items-center ">
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
                            labels: ['Reservado', 'Não Reservados'],
                            datasets: [{
                                label: '',

                                data: ['<?php  echo  valoresGraficoQuantidadeEpi('indisponivel') ?>', '<?php  echo  valoresGraficoQuantidadeEpi('disponivel') ;?>'],

                                backgroundColor: [
                                    'rgba(219,2,2,0.8)',
                                    'rgba(42,197,143,0.8)'
                                ],
                                borderColor: [
                                    'rgba(219,2,2)',
                                    'rgba(42,197,143)'

                                ],
                                borderWidth: 2
                            }]
                        },
                        options: {
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Quantidade de Items Reservados',
                                    padding: {
                                        top: 10,
                                        bottom: 30
                                    }
                                }},
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
                                $numPeople = 0;
                                $TOTALFIMEND =  valoresGraficoTopFuncionarios('nome');
                                foreach ($TOTALFIMEND as  $key => $value){
                                if($numPeople < 5){

                                ?>
                                '<?php echo $key;?>',
                                <?php
                                }
                                $numPeople = $numPeople + 1;
                                }
                                ?>
                            ],
                            datasets: [{
                                label: 'Quantidade de Aluguéis feitos',

                                data: [
                                    <?php
                                    $numValores = 0;
                                    $TOTALFIMEND =  valoresGraficoTopFuncionarios('valor');
                                    foreach ($TOTALFIMEND as  $key => $value){
                                    if($numValores < 5){
                                    ?>
                                    '<?php echo $value;?>',
                                    <?php
                                    $numValores = $numValores + 1;
                                    }
                                    }
                                    ?>
                                ],

                                backgroundColor: [
                                    'rgba(183, 28, 28,0.8)',
                                    'rgba(255, 111, 0,0.8)',
                                    'rgba(255,186,8,0.8)',
                                    'rgba(63,132,229,0.8)',
                                    'rgba(22,152,115,0.8)',

                                ],
                                borderColor: [
                                    'rgba(183, 28, 28)',
                                    'rgba(255, 111, 0)',
                                    'rgba(255,186,8)',
                                    'rgba(63,132,229)',
                                    'rgba(22,152,115)',


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

<!-- Modal Banner -->
<div class="modal fade" id="modalEpiAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Epi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" name="frmEpiAdd" id="frmEpiAdd">

                <div class="modal-body quasebranco ">
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="fotoEpiAdd" name="fotoEpiAdd" >
                        <label class="input-group-text" for="fotoEpiAdd">Foto</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="nomeEpiAdd" name="nomeEpiAdd" >
                        <label class="input-group-text" for="nomeEpiAdd">Nome do Epi</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="certificadoEpiAdd" name="certificadoEpiAdd" maxlength="7" minlength="5">
                        <label class="input-group-text" for="certificadoEpiAdd" >Certificado</label>
                    </div>
                </div>
                <div class="modal-footer quasebranco ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" id="btnEpiAdd">Cadastrar</button>
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