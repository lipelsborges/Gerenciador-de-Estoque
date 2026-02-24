<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Excluir Loja |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/lojas_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();

$id = sanitizar($_GET['id'] ,'inteiro');
$erro = null;

if(!$id){

    header('location:listar.php');
    exit;

}

try {

    $lojas = buscarLojaPorId($conexao, $id);
    if(!$lojas) $erro = 'Loja não encontrada';
    
} catch (Throwable $error) {

    $erro = "Erro ao buscar as Lojas". $error->getMessage();
    
}

if(isset($_GET['confirmar-exclusao']) && !$erro)
    try {

        excluirLoja($conexao,$id);
        header('location:listar.php');
        exit;
        
    } catch (Throwable $error) {

        $erro = 'Erro ao excluir a loja'. $error->getMessage();
        
    }



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Loja</h3>
    
    <?php if ($erro):  ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php else: ?>

    <div class="alert alert-danger w-50 text-center mx-auto">
        <p>Tem certeza que deseja excluir a loja <b><?= $lojas['nome'] ?? '' ?></b>?</p>
        <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
        <a href="?id=<?=$lojas['id'] ?>&confirmar-exclusao" class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
    </div>
<?php endif; ?>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>