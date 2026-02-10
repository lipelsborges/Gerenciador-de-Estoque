<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Registro de Estoque |";
require_once BASE_PATH . '/includes/cabecalho.php'; 



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Estoque</h3>


    <form action="" method="post" class="w-75 mx-auto">

        <input type="hidden" name="loja_id" value="ID da loja"> 
        <input type="hidden" name="produto_id" value="ID do produto">
        
        <div class="form-group">

            <label for="estoque" class="form-label">Quantidade: </label>
            <input type="number" class="form-control" id="estoque" name="estoque" value="Quantidade..." min="0" required>

        </div>

        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>