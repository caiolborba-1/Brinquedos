<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = trim($_POST["nome"]);
    $categoria = trim($_POST["categoria"]);
    $faixa_etaria = trim($_POST["faixa_etaria"]);
    $preco = $_POST["preco"];
    $quantidade_estoque = $_POST["quantidade_estoque"];

    if ($nome != "" && $categoria != "" && $faixa_etaria != "" && is_numeric($preco) && $preco >= 0 && is_numeric($quantidade_estoque) && $quantidade_estoque >= 0) {
        $sql = "INSERT INTO brinquedos (nome, categoria, faixa_etaria, preco, quantidade_estoque) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssdi", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque); $stmt->execute(); $stmt->close();

            header("Location: index.php");
            exit;
        }
    }
}



$sql = "SELECT id, nome, categoria, faixa_etaria, preco, quantidade_estoque
        FROM brinquedos";

$stmt = $conexao->prepare($sql);
$stmt->execute();

$resultado = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gestão de Brinquedos</title>
</head>

<body>

    <h2>Cadastrar Brinquedo</h2>

    <form method="POST">

        <label>Nome:</label>
            <br>
        <input type="text" name="nome" required>

        <br><br>

        <label>Categoria:</label>
            <br>
        <input type="text" name="categoria" required>
            <br><br>
        <label>Faixa Etária:</label>
            <br>
        <input type="text" name="faixa_etaria" placeholder="Ex: 5 a 10 anos" required>
            <br><br>
        <label>Preço:</label>
            <br>
        <input type="number" name="preco" step="0.01" min="0" required>
            <br><br>
        <label>Quantidade em Estoque:</label>
            <br>
        <input type="number" name="quantidade_estoque" min="0" required>
            <br><br>
        <input type="submit" value="Cadastrar Brinquedo">

    </form>

    <h2>Brinquedos Cadastrados</h2>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Categoria</th>
            <th>Faixa Etária</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>

        <?php while ($brinquedo = $resultado->fetch_assoc()) { ?>

            <tr>

                <td> <?php echo $brinquedo["id"]; ?></td>
                <td> <?php echo htmlspecialchars($brinquedo["nome"]); ?></td>
                <td> <?php echo htmlspecialchars($brinquedo["categoria"]); ?></td>
                <td><?php echo htmlspecialchars($brinquedo["faixa_etaria"]); ?></td>
                <td> R$ <?php echo number_format($brinquedo["preco"], 2, ",", "."); ?></td>
                <td><?php echo $brinquedo["quantidade_estoque"]; ?></td>

                <td>
                    <a href="editar.php?id=<?php echo $brinquedo["id"]; ?>">Editar</a>
                    <a href="excluir.php?id=<?php echo $brinquedo["id"]; ?>">Excluir</a>
                </td>

            </tr>

        <?php } ?>

    </table>

</body>

</html>

<?php
$stmt->close();
$conexao->close();
?>