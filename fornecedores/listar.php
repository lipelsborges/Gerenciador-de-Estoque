<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Fornecedores |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/fornecedor_crud.php';

exigirLogin();

$erro = null;
$fornecedores = [];

try {

    $fornecedores = buscarFornecedor($conexao);
    
} catch (Throwable $error) {

    $erro = "Erro ao buscar Fornecedor" . $error->getMessage();
    
}



?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-people-fill"></i> Fornecedores</h3>
    <p>
        <a  class="btn btn-primary" href="inserir.php">
           <i class="bi bi-plus-circle"></i> Adicionar novo fornecedor
        </a>
    </p>
    <form action="" method="get" class="mx-auto my-4">
        <div class="row  g-2 justify-content-center mb-3">
            <div class="col-auto">
                <input  type="search" name="search" class="form-control" placeholder="Buscar fornecedor...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: <?= count($fornecedores) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th >ID</th>
                    <th >Nome</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
<?php foreach($fornecedores as $fornecedor): ?>
                <tr>
                    <td ><?= $fornecedor['id'] ?></td>
                    <td ><?= $fornecedor['nome'] ?></td>
                    <td ><a href="editar.php" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a></td>
                    <td ><a href="excluir.php" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a></td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>