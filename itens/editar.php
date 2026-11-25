<?php
require_once '../includes/verificar_login.php';
require_once '../config/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id <= 0) {
    header('Location: listar.php');
    exit;
}

$stmt = $conexao->prepare("SELECT id, codigo_sku, nome, quantidade, estoque_minimo FROM itens_estoque WHERE id = :id");
$stmt->execute([':id' => $id]);
$item = $stmt->fetch();

if (!$item) {
    header('Location: listar.php');
    exit;
}

require_once '../includes/cabecalho.php';
require_once '../includes/menu.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-3">Editar Item</h2>

            <?php if (!empty($_GET['erro'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['erro']) ?>
                </div>
            <?php endif; ?>

            <form action="atualizar.php" method="POST">
                <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">

                <div class="mb-3">
                    <label for="codigo_sku" class="form-label">Código SKU</label>
                    <input type="text" class="form-control" id="codigo_sku" name="codigo_sku"
                           value="<?= htmlspecialchars($item['codigo_sku']) ?>" required maxlength="50">
                </div>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Item</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                           value="<?= htmlspecialchars($item['nome']) ?>" required maxlength="120">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantidade" class="form-label">Quantidade em Estoque</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade"
                               min="0" step="1" value="<?= (int) $item['quantidade'] ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="estoque_minimo" class="form-label">Estoque Mínimo</label>
                        <input type="number" class="form-control" id="estoque_minimo" name="estoque_minimo"
                               min="0" step="1" value="<?= (int) $item['estoque_minimo'] ?>" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/rodape.php'; ?>