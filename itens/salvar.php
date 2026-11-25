<?php
require_once '../includes/verificar_login.php';
require_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: cadastrar.php');
    exit;
}

$codigo_sku = trim($_POST['codigo_sku'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$quantidade_raw = $_POST['quantidade'] ?? '';
$estoque_minimo_raw = $_POST['estoque_minimo'] ?? '';

if (
    $codigo_sku === '' ||
    $nome === '' ||
    filter_var($quantidade_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false ||
    filter_var($estoque_minimo_raw, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]) === false
) {
    $msg = urlencode('Preencha todos os campos corretamente com valores inteiros maiores ou iguais a zero.');
    header("Location: cadastrar.php?erro={$msg}");
    exit;
}

$quantidade = (int) $quantidade_raw;
$estoque_minimo = (int) $estoque_minimo_raw;

$sql = "INSERT INTO itens_estoque (codigo_sku, nome, quantidade, estoque_minimo) VALUES (:codigo_sku, :nome, :quantidade, :estoque_minimo)";
$stmt = $conexao->prepare($sql);
$stmt->execute([
    ':codigo_sku' => $codigo_sku,
    ':nome' => $nome,
    ':quantidade' => $quantidade,
    ':estoque_minimo' => $estoque_minimo,
]);

header('Location: listar.php');
exit;