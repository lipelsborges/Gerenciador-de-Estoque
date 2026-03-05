<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Registro de Estoque |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/estoque_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();

$loja_id = sanitizar($_GET['loja_id'], 'inteiro');
$produto_id = sanitizar($_GET['produto_id'], 'inteiro');
$erro = null;

if(!$loja_id || !$produto_id){
    header("location:listar.php");
    exit;
}

try {
    $estoque = buscarEstoquePorIds($conexao, $loja_id, $produto_id);
    if(!$estoque) $erro = "Estoque não encontrado";
} catch (Throwable $error) {
    $erro = "Erro ao buscar estoque. <br>".$error->getMessage();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $estoque = sanitizar($_POST['estoque'], 'inteiro');

    try {
        atualizarEstoque($conexao, $loja_id, $produto_id, $estoque);
        header("location:listar.php");
        exit;
    } catch (PDOException $error) {
        $codigoErro = $error->errorInfo[1] ?? null;
        if($codigoErro === 4025){
            $erro = "O estoque não pode ser negativo.";
        } else {
            $erro = "Erro ao atualizar os dados. <br>" . $error->getMessage();
        }
    }catch (Throwable $error) {
        $erro = "Erro inesperado. <br>" . $error->getMessage();
    }
}

?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Estoque</h3>

    <?php if ($erro): ?>
         <div class="alert alert-danger text-center"><?= $erro ?></div>
    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">

        <input type="hidden" name="loja_id" value="<?= $estoque['loja_id'] ?? ''?>"> 
        <input type="hidden" name="produto_id" value="<?= $estoque['produto_id'] ?? '' ?>">
        
        <div class="form-group mb-3">
            <label for="loja">Loja: </label>
            <input disabled readonly type="text" class="form-control" id="loja" name="loja" value="<?= $estoque['nome_loja'] ?? '' ?>">
        </div>

        <div class="form-group mb-3">
            <label for="produto">Produto: </label>
            <input disabled readonly type="text" class="form-control" id="produto" name="produto" value="<?= $estoque['nome_produto'] ?? '' ?>">
        </div>

        <div class="form-group">

            <label for="estoque" class="form-label">Quantidade: </label>
            <input type="number" class="form-control" id="estoque" name="estoque" value="<?= $estoque['estoque'] ?? 0 ?>" min="0">

        </div>

        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>