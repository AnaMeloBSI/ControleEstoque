<?php
require_once '../includes/verificar_login.php';
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listar.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$codigo_sku = trim($_POST['codigo_sku'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$quantidade_raw = $_POST['quantidade'] ?? '';
$estoque_minimo_raw = $_POST['estoque_minimo'] ?? '';

if (!$id || $id <= 0) {
    header('Location: listar.php');
    exit;
}

if (
    $codigo_sku === '' ||
    $nome === '' ||
    filter_var($quantidade_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false ||
    filter_var($estoque_minimo_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false
) {
    $msg = urlencode('Preencha todos os campos corretamente com valores inteiros maiores ou iguais a zero.');
    header("Location: editar.php?id={$id}&erro={$msg}");
    exit;
}

$quantidade = (int) $quantidade_raw;
$estoque_minimo = (int) $estoque_minimo_raw;

$sql = "UPDATE itens_estoque
        SET codigo_sku = :codigo_sku, nome = :nome, quantidade = :quantidade, estoque_minimo = :estoque_minimo
        WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->execute([
    ':codigo_sku' => $codigo_sku,
    ':nome' => $nome,
    ':quantidade' => $quantidade,
    ':estoque_minimo' => $estoque_minimo,
    ':id' => $id,
]);

header('Location: listar.php');
exit;