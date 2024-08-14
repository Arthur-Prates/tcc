<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Termo de Responsabilidade</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/4.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#90bae0">
    <link rel="stylesheet" href="../css/style.css">
    <style>

        #signature-pad {
            border: 1px solid #000;
            width: 100%;
            height: 200px;
        }

        .button {
            margin-top: 10px;
        }
    </style>
    <script>
        function getdataFomartadaEmContrato() {
            let day = new Date().getDate();
            let month = new Date().getMonth(); // Janeiro é 0
            let year = new Date().getFullYear();
            const meses = [
                "janeiro", "fevereiro", "março", "abril", "maio", "junho",
                "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"
            ];
            if (day < 10) {
                day = '0' + day;
            }

            let mesPorExtenso = meses[month];

            return `Governador Valadares,  ${day} de ${mesPorExtenso} de ${year}`;

        }

        function exibirData() {
            document.getElementById('dataContrato').innerText = getdataFomartadaEmContrato();
        }
    </script>
</head>
<body onload="exibirData()" class="mt-5 mb-5 ">


<div class="container show bg-white p-5" id="show"
     style="max-width: 1000px;border:1px solid black; border-radius: 10px">

    <div class="d-flex justify-content-center align-items-center ">
        <img src="../img/logo/logologin.png" alt="SAFETECH" title="SAFETECH" class="img-fluid" style="max-width: 250px">
    </div>
    <?php
    $emprestimo = $_POST['CodigoEmprestimo'];

    $listaEmprestimo = listarItemExpecifico('*', 'emprestimo', 'codigoEmprestimo', $emprestimo);
    foreach ($listaEmprestimo as $item) {
        $idusuario = $item->idusuario;

    }
    $listaUsuario = listarItemExpecifico('*', 'usuario', 'idusuario', $idusuario);
    ?>

    <h1 class="text-center">TERMO DE RESPONSABILIDADE DE EMPRÉSTIMO DE EPI</h1>
    <?php
    foreach ($listaUsuario as $user) {
        $nome = $user->nomeUsuario;
        $sobrenome = $user->sobrenome;
        $cpf = $user->cpf;
        $cargo = $user->cargo;
        $celular = $user->numero;
        $nomeCompleto = "$nome $sobrenome";
        if ($cargo == 'adm') {
            $cargo = 'Adminstrador';
        } else if ($cargo == 'funcionario') {
            $cargo = 'Funcionário';
        } else if ($cargo == 'almoxarife') {
            $cargo = 'Almoxarife';
        } else if ($cargo == 'rh') {
            $cargo = 'Recursos Humanos';
        } else {
            $cargo = 'Indisponível';
        }
        ?>

        <p><b>NOME COMPLETO: </b><?php echo $nomeCompleto ?></p>
        <p><b>CARGO: </b><?php echo $cargo ?></p>
        <p><b>CPF: </b><?php echo $cpf ?></p>
        <p><b>CELULAR: </b><?php echo $celular ?></p>
        <?php
    }
    ?>


    <hr>
    <p>
        ° Recebi da MAQUINASTECH, a título de empréstimo, os Equipamentos de Proteção Individual - EPIs, abaixo
        relacionados, me comprometendo a usá-los unicamente para os fins a que se destinam
        e estou ciente da obrigatoriedade do seu uso.
        <br>
        <br>
        ° Também assumo a responsabilidade de devolver os EPIs nas mesmas condições em que os recebi,
        considerando o desgaste natural decorrente do uso adequado.
        <br>
        <br>
        ° Declaro ainda, utilizar com cuidado e zelo o equipamento de proteção individual
        emprestado e afirmo ter verificado, antes do recebimento, que o equipamento se
        encontra em perfeitas condições de uso e bom estado de conservação.

    </p>
    <hr>
    <?php
    $listarITEMS = listarTabelaInnerJoinTriploOrdenadaExpecifica('*', 'produtoemprestimo', 'epi', 'emprestimo', 'idepi', 'idepi', 'codEmprestimo', 'codigoEmprestimo', 'codigoEmprestimo', "$emprestimo", 'nomeEpi', 'ASC');


    ?>
    <div class="overflowTable">
        <table class="table table-bordered border-dark text-center rounded-table ">
            <thead class="table-dark ">
            <tr class="">
                <th scope="col">NOME</th>
                <th scope="col">QUANTIDADE</th>
                <th scope="col">DATA DE RECEBIMENTO</th>
                <th scope="col">DATA DE DEVOLUÇÃO</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($listarITEMS) {
                foreach ($listarITEMS as $produto) {
                    $nomeEPI = $produto->nomeEpi;
                    $quantidade = $produto->quantidade;
                    $dataIn = $produto->dataInicialEmprestimo;
                    $dataOut = $produto->dataFinalEmprestimo;
                    $dataIn = new DateTime($dataIn);
                    $dataOut = new DateTime($dataOut);
                    $dataIn = $dataIn->format('d/m/Y');
                    $dataOut = $dataOut->format('d/m/Y');
                    ?>
                    <tr>
                        <td>
                            <?php echo $nomeEPI ?>
                        </td>
                        <td>
                            <?php echo $quantidade ?>
                        </td>
                        <td>
                            <?php echo $dataIn ?>
                        </td>
                        <td>
                            <?php echo $dataOut ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>

    </div>
    <br>
    <hr>
    <br>
    <p style="text-align: justify;">

        O Equipamento de Proteção Individual - EPI é destinado à proteção de riscos
        suscetíveis de ameaçar a segurança e a saúde no trabalho do trabalhador e/ou do
        visitante nas áreas operacionais da MAQUINASTECH em Governador Valadares.

    </p>
    <p class="text-center"><b><span id="dataContrato"></span></b></p>

    <hr>

    Assinatura do Funcionário Devedor:
    <canvas id="signature-pad"></canvas>
    <button id="clear" class="btn btn-danger"><span class="bi bi-trash"></span> Limpar</button>
    <div class="d-flex justify-content-center align-items-center ">
        <input type="text" value="<?php echo $emprestimo?>" name="valorEmprestimo" id="valorEmprestimo" hidden="hidden" >
        <button id="save" class="btn btn-dark">Salvar Assinatura</button>
    </div>


</div>
<button onclick="voltarAoTopo()" id="btnTopo" class="btnTopo" title="Voltar ao Topo"><i
            class="bi bi-arrow-up-short"></i></button>
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
<script src="../js/script.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

<script>
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    let isDrawing = false;

    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    canvas.addEventListener('mousedown', (e) => {
        isDrawing = true;
        ctx.moveTo(e.offsetX, e.offsetY);
    });

    canvas.addEventListener('mousemove', (e) => {
        if (isDrawing) {
            ctx.lineTo(e.offsetX, e.offsetY);
            ctx.stroke();
        }
    });

    canvas.addEventListener('mouseup', () => {
        isDrawing = false;
    });

    document.getElementById('clear').addEventListener('click', () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        window.location.reload()
    });

    document.getElementById('save').addEventListener('click', () => {
        const dataURL = canvas.toDataURL('image/png');
        const valorEmprestimo = document.getElementById('valorEmprestimo').value
        fetch('salvar_assinatura.php', {
            method: 'POST',
            body: JSON.stringify({image: dataURL}),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => response.text())
            .then(data => {
                alert(`Assinatura salva com sucesso!`);
                redireciona(`verificarAluguel.php?emprestimo=${valorEmprestimo}`)
            }).catch(error => {
            console.error('Erro ao salvar assinatura:', error);
        });
    });
</script>

</body>
</html>
