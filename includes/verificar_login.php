<?php
$chave_cookie = 'chave_secreta_controle_estoque_2026';

function obter_usuario_cookie($chave)
{
    if (empty($_COOKIE['estoque_auth'])) {
        return null;
    }

    $partes = explode('.', $_COOKIE['estoque_auth']);
    if (count($partes) !== 2) {
        return null;
    }

    [$usuario_id, $assinatura] = $partes;
    if (!ctype_digit($usuario_id)) {
        return null;
    }

    $assinatura_esperada = hash_hmac('sha256', $usuario_id, $chave);
    if (!hash_equals($assinatura_esperada, $assinatura)) {
        return null;
    }

    return (int) $usuario_id;
}

$usuario_id = obter_usuario_cookie($chave_cookie);

if ($usuario_id === null) {
    $em_subpasta = (basename(dirname($_SERVER['PHP_SELF'])) === 'itens');
    $caminho_login = $em_subpasta ? '../login/login.php' : 'login/login.php';
    header("Location: $caminho_login");
    exit;
}