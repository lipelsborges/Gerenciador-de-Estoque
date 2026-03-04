<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Excluir Produto |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/produtos_crud.php';
require_once BASE_PATH . '/src/utils.php';

$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;

exigirLogin();

if(!$id){
    header('location:listar.php');
    exit;
}

try {
    $produto = buscarProdutoPorId($conexao, $id);
    if(!$produto) $erro = "Produto não encontrado";
    
} catch (Throwable $error) {

    $erro = "Erro ao buscar produto <br>". $error->getMessage();
}

if(isset($_GET['confirmar-exclusao'])){
    try {
        excluirProduto($conexao, $id);
        header("location:listar.php");
        exit;
    } catch (Throwable $error) {
        if ($error->getCode() === '23000') {
            $erro = "Não é possível excluir o produto <b>". $produto['nome']. "</b> porque ele está
                     vinculado ao estoque de uma ou mais lojas.";
        
        } else {

            $erro = "Erro ao excluir produto.". $error->getMessage();

        }
        
        
    }
}

?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Produto</h3>

    <?php if($erro):?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php else: ?>
            <div class="alert alert-danger w-50 text-center mx-auto">
                <p>Tem certeza que deseja excluir o produto <b><?= $produto['nome'] ?></b>?</p>
                <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
                <a href="?id=<?=$produto['id']?>&confirmar-exclusao" class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
            </div>

    <?php endif; ?>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>