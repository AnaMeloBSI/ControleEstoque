<?php
require_once '../includes/verificar_login.php';
require_once '../config/conexao.php';

$stmt = $conexao->query("SELECT id, codigo_sku, nome, quantidade, estoque_minimo FROM itens_estoque ORDER BY nome ASC");
$itens = $stmt->fetchAll();

$itens_baixo_estoque = array_filter($itens, function ($item) {
    return (int) $item['quantidade'] <= (int) $item['estoque_minimo'];
});

require_once '../includes/cabecalho.php';
require_once '../includes/menu.php';
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Itens em Estoque</h2>
        <a href="cadastrar.php" class="btn btn-primary">Novo Item</a>
    </div>

    <?php if (count($itens_baixo_estoque) > 0): ?>
        <div class="alert alert-warning" role="alert">
            Atenção: existem <strong><?= count($itens_baixo_estoque) ?></strong> item(ns) com quantidade igual ou abaixo do estoque mínimo.
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Estoque Mínimo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($itens) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum item cadastrado até o momento.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($itens as $item): ?>
                        <?php $estoque_baixo = (int) $item['quantidade'] <= (int) $item['estoque_minimo']; ?>
                        <tr class="<?= $estoque_baixo ? 'table-danger' : '' ?>">
                            <td><?= htmlspecialchars($item['codigo_sku']) ?></td>
                            <td><?= htmlspecialchars($item['nome']) ?></td>
                            <td><?= (int) $item['quantidade'] ?></td>
                            <td><?= (int) $item['estoque_minimo'] ?></td>
                            <td>
                                <?php if ($estoque_baixo): ?>
                                    <span class="badge bg-danger">Estoque baixo</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Normal</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="editar.php?id=<?= (int) $item['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="excluir.php?id=<?= (int) $item['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Tem certeza que deseja excluir este item?');">
                                    Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/rodape.php'; ?>