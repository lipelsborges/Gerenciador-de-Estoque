<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Loja |";
require_once BASE_PATH . '/includes/cabecalho.php'; 

exigirLogin();


?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Registro de Estoque</h3>

    <form action="" method="post" class="w-75 mx-auto">
        <div class="form-group">
            <label for="loja" class="form-label">Loja: </label>
            <select class="form-select" name="loja_id" id = "loja">
                <option value="">Selecione uma loja</option>
                <option value="">Loja de Eletrônicos</option>
            </select>
        </div>
        <div class="form-group">
            <label for="produto_id" class="form-label">Produto: </label>
            <select class="form-select" name="produto_id" id = "produto">
                <option value="">Selecione um produto</option>
                <option value="">Smartphone XYZ</option>
            </select>
        </div>
        <div class="form-group">
            <label for="estoque" class="form-label">Estoque: </label>
            <input type="number" class="form-control" id="estoque" name="estoque" min="0" required>
        </div>
        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i>  Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>