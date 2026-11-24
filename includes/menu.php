<?php
$em_subpasta = (basename(dirname($_SERVER['PHP_SELF'])) === 'itens');
$base = $em_subpasta ? '..' : '.';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?= $base ?>/index.php">Controle de Estoque</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/index.php">Painel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/itens/listar.php">Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>/itens/cadastrar.php">Novo Item</a>
                </li>
            </ul>
            <a class="btn btn-outline-light btn-sm" href="<?= $base ?>/login/sair.php">Sair</a>
        </div>
    </div>
</nav>
<main class="container mb-5">