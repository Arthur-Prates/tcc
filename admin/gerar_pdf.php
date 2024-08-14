<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
require '../dompdf/vendor/autoload.php';

//Se quiser ver o código da classe, clique Ctrl + Botão esquerdo do mouse sobre a classe ou o método desejado
//Faz a referência ao namespace/package Dompdf
use Dompdf\Dompdf;

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dados);

if (isset($dados) && !empty($dados)) {
    $codigoEmprestimo = isset($dados['codigoEmprestimoPdf']) ? addslashes($dados['codigoEmprestimoPdf']) : '';

    $listarUsuario = listarTabelaInnerJoinOrdenadaExpecifiica('*', 'emprestimo', 'usuario', 'idusuario', 'idusuario', 'codigoEmprestimo', "$codigoEmprestimo", 'b.nomeUsuario', 'ASC');
    foreach ($listarUsuario as $usuario) {
        $nome = $usuario->nomeUsuario;
        $sobrenome = $usuario->sobrenome;
        $cpf = $usuario->cpf;
        $cargo = $usuario->cargo;
        $celular = $usuario->numero;
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
    }

    $pdf = "<!doctype html>";
    $pdf .= "<html lang='pt-br'>";
    $pdf .= "<head>";
    $pdf .= "<meta charset='utf-8'>";
    $pdf .= "</head>";
    $pdf .= "<body style='padding: 30px'>";
    $pdf .= "<div id='show' style='background-color: white; max-width: 1000px;'>";
    $pdf .= "<div class='' style='justify-content: center; align-items: center; display: flex;'>";
    $pdf .= "<img src='../img/logo/logologin.png' alt='SAFETECH' title='SAFETECH' class='img-fluid' style='max-width: 250px'>";
    $pdf .= "</div>";
    $pdf .= "<div style='display: flex; justify-content: center'>";
    $pdf .= "<h1>TERMO DE RESPONSABILIDADE DE EMPRÉSTIMO DE EPI</h1>";
    $pdf .= "</div>";
    $pdf .= "<p><b>NOME COMPLETO:</b> $nomeCompleto</p>";
    $pdf .= "<p><b>CARGO:</b> $cargo</p>";
    $pdf .= "<p><b>CPF:</b> $cpf</p>";
    $pdf .= "<p><b>CELULAR:</b> $celular</p>";
    $pdf .= "<hr>";
    $pdf .= "<p style='text-align: justify;'>
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
    </p>";
    $pdf .= "<hr>";
    $pdf .= "<table style='border: 1px solid black; width: 100%; justify-content: center;'>";
    $pdf .= "<thead>";
    $pdf .= "<tr>";
    $pdf .= "<th>Nome EPI</th>";
    $pdf .= "<th>Quantidade</th>";
    $pdf .= "<th>Data do recebimento</th>";
    $pdf .= "<th>Data da devoluçao</th>";
    $pdf .= "</tr>";
    $pdf .= "</thead>";
    $pdf .= "<tbody>";
    $listarEmprestimo = listarTabelaInnerJoinQuadruploWherePdf('*', 'emprestimo', 'produtoemprestimo', 'epi', 'usuario', 'codigoEmprestimo', 'codEmprestimo', 'idepi', 'idepi', 'idusuario', 'idusuario', 'codigoEmprestimo', "$codigoEmprestimo", 'nomeEpi', 'ASC');
    foreach ($listarEmprestimo as $itemEmprestimo) {
        $nomeEpi = $itemEmprestimo->nomeEpi;
        $quantidade = $itemEmprestimo->quantidade;
        $dataRecebimento = $itemEmprestimo->dataInicialEmprestimo;
        $dataDevolucao = $itemEmprestimo->dataFinalEmprestimo;

        $pdf .= "<tr style='text-align: center'>";
        $pdf .= "<td>$nomeEpi</td>";
        $pdf .= "<td>$quantidade</td>";
        $pdf .= "<td>$dataRecebimento</td>";
        $pdf .= "<td>$dataDevolucao</td>";
        $pdf .= "<tr>";
    }
    $pdf .= "</tbody>";
    $pdf .= "</table>";
    $pdf .= "<hr>";
    $pdf .= "<p style='text-align: justify;'>
        O Equipamento de Proteção Individual - EPI é destinado à proteção de riscos
        suscetíveis de ameaçar a segurança e a saúde no trabalho do trabalhador e/ou do
        visitante nas áreas operacionais da MAQUINASTECH em Governador Valadares.
    </p>";
    $pdf .= "<hr>";
    $pdf .= "<p>Assinatura do Funcionário:</p>";
    $caminhoAbsolutoImagem = __DIR__ . '/assinaturas/assinatura_1723577901.png';
    if (file_exists($caminhoAbsolutoImagem)) {
        $pdf .= "<img src='data:image/png;base64," . base64_encode(file_get_contents($caminhoAbsolutoImagem)) . "' alt='Assinatura_do_funcionario' style='width: 100%;'>";
    } else {
        $pdf .= "<p>Imagem de assinatura não encontrada.</p>";
    }
    $pdf .= "<hr>";
    $pdf .= "<p>Data: " . date('d/m/Y') . "</p>";
    $pdf .= "";
    $pdf .= "";
    $pdf .= "";
    $pdf .= "";
    $pdf .= "</div>";
    $pdf .= "</body>";
    $pdf .= "";
    $pdf .= "</html>";

//Instancia o objeto
    $dompdf = new Dompdf();
//Carrega o conteúdo html para ser renderizado no PDF, é necessário passar toda a página HTML
    $dompdf->loadHtml($pdf);

//Orientação pode ser 'landscape' ou 'portrait'(Modo padrão), sendo modo paisagem e modo retrato, respectivamente
    $dompdf->setPaper('A4', 'portrait');

//Rederiza o HTML para PDF
    $dompdf->render();
//Gera o pdf para e envia para o browser
    $dompdf->stream('confirmacao_de_retirada_do_epi_' . $codigoEmprestimo . '.pdf');

}
