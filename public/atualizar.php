<?php

include "../infra/conexao.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: index.php");
    exit;
}

$id = $_POST["id"];
$nome = trim($_POST["nome"]);
$categoria = trim($_POST["categoria"]);
$faixa_etaria = trim($_POST["faixa_etaria"]);
$preco = $_POST["preco"];
$quantidade_estoque = $_POST["quantidade_estoque"];

if (!is_numeric($id) || $nome == "" || $categoria == "" || $faixa_etaria == "" || !is_numeric($preco) || $preco < 0 || !is_numeric($quantidade_estoque) || $quantidade_estoque < 0) {
    die("Dados inválidos.");
}

$sql = "UPDATE brinquedos SET nome = ?, categoria = ?, faixa_etaria = ?, preco = ?, quantidade_estoque = ? WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sssidi", $nome, $categoria, $faixa_etaria, $preco, $quantidade_estoque, $id
);

if (!$stmt->execute()) {
    die("Erro ao atualizar o brinquedo.");
}

$stmt->close();

header("Location: index.php");
exit;

?>