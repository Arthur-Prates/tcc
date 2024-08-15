<?php
include_once('../config/conexao.php');
include_once('../config/constantes.php');
include_once('../func/funcoes.php');
// Verifica se o corpo da requisição é JSON
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['image'])) {
    $image = $data['image'];
    $codigoEmprestimo = $data['codEmprestimo'];

    // Decodifica o Base64 da imagem
    $image = str_replace('data:image/png;base64,', '', $image);
    $image = str_replace(' ', '+', $image);
    $imageData = base64_decode($image);

    // Cria um nome de arquivo único
    $fileName = 'assinatura_' . time() . '.png';
    $filePath = 'assinaturas/' . $fileName;


    // Salva a imagem no diretório 'assinaturas'
    if (file_put_contents($filePath, $imageData)) {
        $alterarAssinatura = alterar2Item('emprestimo', 'assinatura','ativo', "$fileName",'A', 'codigoEmprestimo', "$codigoEmprestimo");
        if ($alterarAssinatura > 0) {
            echo json_encode(['success' => true, 'message' => 'Documento assinado com sucesso!']);
        }else{
            echo json_encode(['success' => true, 'message' => 'Ocorreu um erro ao assinar o documento!']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao assinar o documento!']);
    }
} else {
    echo 'Nenhuma imagem recebida.';
}
?>
