<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM brinquedos WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    die("Brinquedo não encontrado.");
}

$brinquedo = $resultado->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Brinquedo</title>
</head>

<body>

    <h1>Editar Brinquedo</h1>
    <form action="atualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $brinquedo["id"]; ?>">

        <label>Nome:</label>
            <br>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($brinquedo["nome"]); ?>" required>

        <br><br>

        <label>Categoria:</label>
            <br>
        <input type="text" name="categoria" value="<?php echo htmlspecialchars($brinquedo["categoria"]); ?>" required>

        <br><br>

        <label>Faixa Etária:</label>
            <br>
        <input type="text" name="faixa_etaria" value="<?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?>" required >

        <br><br>

        <label>Preço:</label>
            <br>
        <input type="number" name="preco" step="0.01" min="0" value="<?php echo $brinquedo["preco"]; ?>" required>

        <br><br>

        <label>Quantidade em Estoque:</label>
            <br>
        <input type="number" name="quantidade_estoque" min="0" value="<?php echo $brinquedo["quantidade_estoque"]; ?>" required>
            <br><br>
        <input type="submit" value="Atualizar">

    </form>
    <br>

    <a href="index.php">Voltar</a>

</body>

</html>