<?php
setcookie('estoque_auth', '', [
    'expires' => time() - 3600,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax'
]);

header('Location: login.php');
exit;