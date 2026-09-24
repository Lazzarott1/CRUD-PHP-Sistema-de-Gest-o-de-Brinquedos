<?php

include '../infra/conexao.php';
include '../infra/validacao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit();
}

$nome_brinquedo = trim($_POST['nome_brinquedo'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$faixa_etaria = trim($_POST['faixa_etaria'] ?? '');
$preco = str_replace(',', '.', trim($_POST['preco'] ?? ''));
$quantidade_estoque = trim($_POST['quantidade_estoque'] ?? '');

$erros = validarBrinquedo($nome_brinquedo, $categoria, $faixa_etaria, $preco, $quantidade_estoque);

if (!empty($erros)) {
    foreach ($erros as $erro) {
        echo htmlspecialchars($erro) . "<br>";
    }
    echo "<br><a href='../index.php'>Voltar</a>";
    exit();
}

$preco = (float) $preco;
$quantidade_estoque = (int) $quantidade_estoque;

$sql = "INSERT INTO brinquedos (nome_brinquedo, categoria, faixa_etaria, preco, quantidade_estoque) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conexao, $sql);

if ($stmt === false) {
    die("Erro ao preparar a inserção do brinquedo: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, 'sssdi', $nome_brinquedo, $categoria, $faixa_etaria, $preco, $quantidade_estoque);

if (mysqli_stmt_execute($stmt)) {
    echo "Brinquedo cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar brinquedo: " . mysqli_stmt_error($stmt);
}

echo "<br><a href='../index.php'>Voltar</a>";
mysqli_stmt_close($stmt);

?>