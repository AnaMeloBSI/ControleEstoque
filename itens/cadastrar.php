<?php
require_once '../includes/verificar_login.php';
require_once '../includes/cabecalho.php';
require_once '../includes/menu.php';
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-3">Cadastrar Item</h2>

            <?php if (!empty($_GET['erro'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_GET['erro']) ?>
                </div>
            <?php endif; ?>

            <form action="salvar.php" method="POST">
                <div class="mb-3">
                    <label for="codigo_sku" class="form-label">Código SKU</label>
                    <input type="text" class="form-control" id="codigo_sku" name="codigo_sku" required maxlength="50">
                </div>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Item</label>
                    <input type="text" class="form-control" id="nome" name="nome" required maxlength="120">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="quantidade" class="form-label">Quantidade Inicial</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" step="1" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="estoque_minimo" class="form-label">Estoque Mínimo</label>
                        <input type="number" class="form-control" id="estoque_minimo" name="estoque_minimo" min="0" step="1" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="listar.php" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php require_once '../includes/rodape.php'; ?>