<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Excluir Registro de Estoque |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/estoque_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();
$erro = null;
$loja_id = sanitizar($_GET['loja_id'], 'inteiro');
$produto_id = sanitizar($_GET['produto_id'], 'inteiro');

if (!$loja_id || !$produto_id) {
    header('Location: listar.php');
    exit;
}

try {
    $estoque = buscarEstoquePorIds($conexao, $loja_id, $produto_id);
    if (!$estoque) $erro = "Estoque não encontrado.";
     
    
} catch (Exception $error) {
    $erro = "Erro ao buscar registro: " . $error->getMessage();
}

if(isset($_GET['confirmar-exclusao'])) {
    try {
        excluirEstoque($conexao, $loja_id, $produto_id);
        header('Location: listar.php');
        exit;
    } catch (Throwable $error) {
        $erro = "Erro ao excluir estoque: " . $error->getMessage();
    }
}

?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir produto do estoque da loja</h3>

     <?php if ($erro): ?>
         <div class="alert alert-danger text-center"><?= $erro ?></div>
    <?php else: ?>

    <div class="alert alert-danger w-50 text-center mx-auto">
        <p>Tem certeza que deseja excluir o produto <b><?= $estoque['nome_produto'] ?? '' ?></b> da 
            <b><?= $estoque['nome_loja'] ?? '' ?></b>?</p>
        <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
        <a href="?loja_id=<?= $estoque['loja_id'] ?>&produto_id=<?= $estoque['produto_id'] ?>&confirmar-exclusao" 
            class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
    </div>
    <?php endif; ?>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>