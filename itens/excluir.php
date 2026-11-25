<?php
require_once '../includes/verificar_login.php';
require_once '../config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id && $id > 0) {
    $stmt = $conexao->prepare("DELETE FROM itens_estoque WHERE id = :id");
    $stmt->execute([':id' => $id]);
}

header('Location: listar.php');
exit;