<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Produto |";
require_once BASE_PATH . '/includes/cabecalho.php';

exigirLogin();

?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Produto</h3>

    <form action="" method="post" class="w-75 mx-auto">
        <input type="hidden" name="id" value="ID do produto...">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="Nome do produto">

            <label for="descricao" class="form-label">Descrição: </label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="Descrição do produto">

            <label for="fornecedor" class="form-label">Fornecedor: </label>
            <select class="form-select" id="fornecedor" name="fornecedor">

                <option value="1" selected>Fornecedor 1</option>
                <option value="2">Fornecedor 2</option>
                <option value="3">Fornecedor 3</option>

            </select>
            <label for="preco" class="form-label">Preço: </label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="0.00">

            <label for="quantidade" class="form-label">Quantidade: </label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" value="0">

            <h4 class="mt-4">Detalhe do Produto</h4>
            <label for="detalhes" class="form-label">Peso(kg): </label>
            <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="0.00">  

            <label for="detalhes" class="form-label mt-2">Dimensões (LxAxP): </label>
            <input type="text" class="form-control" id="dimensoes" name="dimensoes" value="0x0x0">

            <label for="codigo_barras" class="form-label mt-2">Código de Barras: </label>
            <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" value="0000000000000">

            <label for="data_validade" class="form-label">Data de Validade: </label>
            <input type="date" class="form-control" id="data_validade" name="data_validade" value="2025-12-31">
            
        </div>
        <a href="<?= BASE_URL ?>/produtos/listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left"></i> Voltar</a>
        <button type="submit" class="btn btn-warning my-4"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
        
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>