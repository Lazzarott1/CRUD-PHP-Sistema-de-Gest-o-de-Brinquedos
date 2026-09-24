<?php

include '../infra/conexao.php';
include '../infra/validacao.php';

$id_brinquedo = isset($_GET['id_brinquedo']) ? (int) $_GET['id_brinquedo'] : 0;

$sql = "SELECT * FROM brinquedos WHERE id_brinquedo = ?";
$stmt = mysqli_prepare($conexao, $sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . mysqli_error($conexao));
}

mysqli_stmt_bind_param($stmt, 'i', $id_brinquedo);
mysqli_stmt_execute($stmt);
$resultadoBrinquedo = mysqli_stmt_get_result($stmt);
$brinquedo = mysqli_fetch_assoc($resultadoBrinquedo);
mysqli_stmt_close($stmt);

if (!$brinquedo) {
    die("Brinquedo não encontrado.<br><a href='../index.php'>Voltar</a>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        echo "<br><a href='editar_brinquedo.php?id_brinquedo=" . urlencode($id_brinquedo) . "'>Voltar</a>";
        exit();
    }

    $preco = (float) $preco;
    $quantidade_estoque = (int) $quantidade_estoque;

    $sql = "UPDATE brinquedos SET nome_brinquedo = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade_estoque = ? WHERE id_brinquedo = ?";
    $stmt = mysqli_prepare($conexao, $sql);

    if ($stmt === false) {
        die("Erro ao preparar a atualização: " . mysqli_error($conexao));
    }

    mysqli_stmt_bind_param($stmt, 'sssdii', $nome_brinquedo, $categoria, $faixa_etaria, $preco, $quantidade_estoque, $id_brinquedo);

    if (mysqli_stmt_execute($stmt)) {
        echo "Brinquedo atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        mysqli_stmt_close($stmt);
        exit();
    } else {
        echo "Erro ao atualizar brinquedo: " . mysqli_stmt_error($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Brinquedo</title>
</head>

<body>
    <h1>Editar Brinquedo!</h1>
    <form method="POST">

        <label for="nome_brinquedo">Nome:</label>
        <input type="text" name="nome_brinquedo" id="nome_brinquedo" maxlength="100" value="<?php echo htmlspecialchars($brinquedo['nome_brinquedo']); ?>" required>
        <br>
        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" maxlength="50" value="<?php echo htmlspecialchars($brinquedo['categoria']); ?>" required>
        <br>
        <label for="faixa_etaria">Faixa Etária:</label>
        <input type="text" name="faixa_etaria" id="faixa_etaria" maxlength="30" value="<?php echo htmlspecialchars($brinquedo['faixa_etaria']); ?>" required>
        <br>
        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco" step="0.01" min="0.01" value="<?php echo htmlspecialchars($brinquedo['preco']); ?>" required>
        <br>
        <label for="quantidade_estoque">Quantidade em Estoque:</label>
        <input type="number" name="quantidade_estoque" id="quantidade_estoque" min="0" value="<?php echo htmlspecialchars($brinquedo['quantidade_estoque']); ?>" required>
        <br>
        <button type="submit">Atualizar Brinquedo</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>

</body>

</html>