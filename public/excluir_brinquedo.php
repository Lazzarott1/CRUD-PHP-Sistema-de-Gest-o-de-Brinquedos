<?php

include '../infra/conexao.php';

$id_brinquedo = isset($_GET['id_brinquedo']) ? (int) $_GET['id_brinquedo'] : 0;

if ($id_brinquedo <= 0) {
    die("ID de brinquedo inválido.<br><a href='../index.php'>Voltar</a>");
}

$stmt = mysqli_prepare($conexao, "DELETE FROM brinquedos WHERE id_brinquedo = ?");

if ($stmt === false) {
    die("Erro ao preparar a exclusão: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, 'i', $id_brinquedo);

if (mysqli_stmt_execute($stmt)) {
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Brinquedo excluído com sucesso.";
    } else {
        echo "Brinquedo não encontrado.";
    }
} else {
    echo "Erro ao excluir brinquedo: " . mysqli_stmt_error($stmt);
}

echo "<br><a href='../index.php'>Voltar</a>";
mysqli_stmt_close($stmt);