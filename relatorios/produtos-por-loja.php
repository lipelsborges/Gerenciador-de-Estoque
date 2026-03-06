<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Produtos por Loja |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/relatorio_crud.php';
require_once BASE_PATH .'/src/lojas_crud.php';
require_once BASE_PATH .'/src/utils.php';

exigirLogin();
$erro = null;
$lojas = [];
$produtos = [];

$id = sanitizar($_GET['loja_id'] ?? '', 'inteiro');

try {
    $lojas = buscarLoja($conexao);
} catch (Throwable $error) {
    $erro  = "Erro ao buscar Fornecedores" . $error->getMessage();
}

try {
    $produtos = $id ? buscarProdutoPorLoja($conexao, $id) : [];
} catch (Throwable $error) {
    $erro = "Erro ao buscar Produto". $error->getMessage();
    
}



?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-box-seam"></i> Produtos por Loja</h3>

    <?php if($erro): ?>
        <p class="alert alert-danger text-center"><?= ($erro) ?></p>
    <?php endif; ?>


<?php if($lojas):  ?>
    <form action="" method="get" class="mx-auto my-4">
        <div class="row g-2 justify-content-center">
          <div class="col-auto">
            <label for="loja_id" class="text-muted col-form-label">Selecione a Loja:</label>
          </div>  
          <div class="col-auto">

            <select onchange="this.form.submit()"
             name="loja_id" id="loja_id" class="form-select">
                <option value=""></option>
                <?php foreach($lojas as $loja): ?>
                    <option <?= $loja['id'] === $id ? 'selected' : '' ?> 
                     value="<?= $loja['id'] ?>">

                        <?= $loja['nome'] ?>

                    </option>
                <?php endforeach; ?>

            </select>

          </div>

        </div>
    </form>
<?php else: ?>
    <p class="alert alert-warning">Nenhuma loja foi cadastrada ainda!</p>
<?php endif; ?>

    <?php if($id && $produtos): ?>
    <p class="fw-semibold">Produtos disponiveis nesta loja: </p>
 

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: <?= count($produtos) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th >Produto</th>
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th>Estoque</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $produto): ?>
                <tr>
                    <td ><?= $produto['produto'] ?></td>
                    <td ><?= formatarPreco($produto['preco']) ?></td>
                    <td ><?= $produto['fornecedor'] ?></td>
                    <td ><?= $produto['estoque'] ?></td>
                    <td><a href="../estoque/editar.php?loja_id=<?=$produto['loja_id']?>&produto_id=<?=$produto['produto_id'] ?>" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-sqaure"></i>Editar</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php elseif($id): ?>
        <p class="alert alert-warning">Nenhum produto encontrado para esta loja.</p>
    <?php endif; ?>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>