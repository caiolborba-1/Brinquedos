<?php

include "../infra/conexao.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID inválido.");
}

$id = $_GET["id"];
$sql = "DELETE FROM brinquedos WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Erro ao excluir o brinquedo.");
}

$stmt->close();

header("Location: index.php");
exit;

?>