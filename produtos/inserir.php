<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Produto |";
require_once BASE_PATH . '/includes/cabecalho.php'; 

exigirLogin();

?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>

    <form action="" method="post" class="w-75 mx-auto">
        <h4>Produto</h4>
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome">

            <label for="descricao" class="form-label mt-2">Descrição: </label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"></textarea>

            <label for="preco" class="form-label mt-2">Preço: </label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco">

            <label for="quantidade" class="form-label mt-2">Quantidade: </label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" min="0">

            <label for="fornecedor_id" class="form-label">Fornecedor: </label>
            <select name="fornecedor_id" id="fornecedor_id" class="form-select">
                <option value=""></option>
                <option value="id do fornecedor">Nome do fornecedor</option>
            </select>

        </div><br>
        <h4>Detalhe do Produto</h4>
        <div class="form-group">
            <label for="detalhes" class="form-label">Peso(kg): </label>
            <input type="number" step="0.01" class="form-control" id="peso" name="peso">

            <label for="detalhes" class="form-label mt-2">Dimensões (LxAxP): </label>
            <input type="text" class="form-control" id="dimensoes" name="dimensoes">

            <label for="codigo_barras" class="form-label mt-2">Código de Barras: </label>
            <input type="text" class="form-control" id="codigo_barras" name="codigo_barras">

            <label for="data_validade" class="form-label mt-2">Data de Validade: </label>
            <input type="date" class="form-control" id="data_validade" name="data_validade">

        </div>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i>  Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>