<?php
$em_subpasta = (basename(dirname($_SERVER['PHP_SELF'])) === 'itens');
$base = $em_subpasta ? '..' : '.';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $base ?>/assets/css/estilo.css">
</head>
<body>