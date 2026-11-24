<?php
require_once 'includes/verificar_login.php';
require_once 'config/conexao.php';
require_once 'includes/cabecalho.php';
require_once 'includes/menu.php';

$sql_usuario = "SELECT nome FROM usuarios WHERE id = :id LIMIT 1";
$stmt_usuario = $conexao->prepare($sql_usuario);
$stmt_usuario->execute([':id' => $usuario_id]);
$dados_usuario = $stmt_usuario->fetch();

$sql_resumo = "SELECT
    COUNT(*) AS total_itens,
    SUM(CASE WHEN quantidade <= estoque_minimo THEN 1 ELSE 0 END) AS itens_baixo_estoque
FROM itens_estoque";
$resumo = $conexao->query($sql_resumo)->fetch();
?>

<div class="row mb-4">
    <div class="col">
        <h2>Painel do Estoque</h2>
        <p class="text-muted mb-0">Bem-vinda, <?= htmlspecialchars($dados_usuario['nome'] ?? 'Usuária') ?>.</p>
    </div>
</div>

<?php if (($resumo['itens_baixo_estoque'] ?? 0) > 0): ?>
    <div class="alert alert-warning">
        Existem <strong><?= (int) $resumo['itens_baixo_estoque'] ?></strong> item(ns) com quantidade igual ou abaixo do estoque mínimo.
    </div>
<?php endif; ?>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Total de Itens Cadastrados</h6>
                <h3><?= (int) ($resumo['total_itens'] ?? 0) ?></h3>
                <a href="itens/listar.php" class="btn btn-primary btn-sm mt-2">Ver Estoque</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Itens em Estoque Mínimo ou Abaixo</h6>
                <h3><?= (int) ($resumo['itens_baixo_estoque'] ?? 0) ?></h3>
                <a href="itens/cadastrar.php" class="btn btn-warning btn-sm mt-2">Cadastrar Item</a>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/rodape.php'; ?>