<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Excluir Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/utils.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';

exigirLogin();

$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;

if (!$id) {
    header('location:listar.php');
    exit;
}

try {

   $fornecedor =  buscarFornecedorPorId($conexao, $id);
    if(!$fornecedor) $erro = 'Fornecedor não encontrado!';
} catch (Throwable $error) {
    $erro = "Erro ao Buscar Fornecedor: <br>". $error->getMessage();
    
}

if(isset($_GET['confirmar-exclusao']) && !$erro)
    try {

        excluirFornecedor($conexao, $id);
        header("location:listar.php");
        exit;

    } catch (Throwable $error) {

        if($error->getCode()=== '23000'){
            $erro = "<b>".$fornecedor['nome']. "</b> está vinculado a outros registros no banco de dados
            , e não pode ser excluído.";

        }else{
            $erro = "Erro ao excluir fornecedor: <br>". $error->getMessage();
        }
    }





?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Fornecedor</h3>
    
    <?php if ($erro):  ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php else: ?>

    <div class="alert alert-danger w-50 text-center mx-auto">
        <p>Tem certeza que deseja excluir o fornecedor <b><?= $fornecedor['nome'] ?? '' ?></b>?</p>
        <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
        <a href="?id=<?= $fornecedor['id'] ?>&confirmar-exclusao" class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
    </div>
<?php endif; ?>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>