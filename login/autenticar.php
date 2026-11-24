<?php
require_once '../config/conexao.php';

$chave_cookie = 'chave_secreta_controle_estoque_2026';
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

if ($email === '' || $senha === '') {
    header('Location: login.php?erro=1');
    exit;
}

$sql = "SELECT id, nome, senha FROM usuarios WHERE email = :email LIMIT 1";
$stmt = $conexao->prepare($sql);
$stmt->execute([':email' => $email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $valor_cookie = $usuario['id'] . '.' . hash_hmac('sha256', (string) $usuario['id'], $chave_cookie);

    setcookie('estoque_auth', $valor_cookie, [
        'expires' => time() + (60 * 60 * 8),
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    header('Location: ../index.php');
    exit;
}

header('Location: login.php?erro=1');
exit;