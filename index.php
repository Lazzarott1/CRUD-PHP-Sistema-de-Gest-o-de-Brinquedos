<?php

include "infra/conexao.php";

$stmt = mysqli_prepare($conexao, "SELECT * FROM brinquedos ORDER BY nome_brinquedo");

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . mysqli_error($conexao));
}

if (!mysqli_stmt_execute($stmt)) {
    die("Erro na consulta: " . mysqli_stmt_error($stmt));
}

$brinquedos = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Brinquedos</title>
</head>

<body>
    <header>
        <h1>Sistema de Gestão de Brinquedos</h1>
    </header>
    <main>

        <h2>Cadastrar Brinquedo!</h2>
        <form action="public/cadastrar_brinquedo.php" method="POST">
            <label for="nome_brinquedo">Nome:</label>
            <input type="text" id="nome_brinquedo" name="nome_brinquedo" maxlength="100" required>
            <br>
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" maxlength="50" required>
            <br>
            <label for="faixa_etaria">Faixa Etária:</label>
            <input type="text" id="faixa_etaria" name="faixa_etaria" maxlength="30" placeholder="Ex.: 3 a 5 anos" required>
            <br>
            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" min="0.01" required>
            <br>
            <label for="quantidade_estoque">Quantidade em Estoque:</label>
            <input type="number" id="quantidade_estoque" name="quantidade_estoque" min="0" required>
            <br>
            <button type="submit">Cadastrar</button>
        </form>

        <div>
            <h2>Brinquedos Cadastrados</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Faixa Etária</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>

                <?php while ($brinquedo = mysqli_fetch_assoc($brinquedos)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($brinquedo["id_brinquedo"]) ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["nome_brinquedo"]) ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["categoria"]) ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["faixa_etaria"]) ?></td>
                        <td>R$ <?php echo number_format($brinquedo["preco"], 2, ',', '.') ?></td>
                        <td><?php echo htmlspecialchars($brinquedo["quantidade_estoque"]) ?></td>
                        <td>
                            <a href="public/editar_brinquedo.php?id_brinquedo=<?php echo urlencode($brinquedo["id_brinquedo"]) ?>">Editar</a>
                            <a href="public/excluir_brinquedo.php?id_brinquedo=<?php echo urlencode($brinquedo["id_brinquedo"]) ?>" onclick="return confirm('Deseja realmente excluir este brinquedo?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </main>
    <footer>

    </footer>
</body>

</html>