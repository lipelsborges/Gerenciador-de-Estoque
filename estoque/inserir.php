<?php

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Loja |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/estoque_crud.php';
require_once BASE_PATH . '/src/produtos_crud.php';
require_once BASE_PATH . '/src/lojas_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();
$erro = null;

$lojas = [];
$produtos = [];

try {
    $lojas = buscarLoja($conexao);
    $produtos = buscarProduto($conexao);
} catch (Throwable $error) {
    $erro = 'erro ao buscar Lojas ou Estoque' . $error->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estoque = sanitizar($_POST['estoque'], 'inteiro');

    if (empty($estoque)) {

        $erro = 'Preencha o campo estoque!';

    } else {

        try {

            inserirEstoque($conexao, $_POST['loja_id'], $_POST['produto_nome'], $estoque);
            header('location:listar.php');
            exit;

        } catch (Throwable $error) {

            $erro = "Erro ao inserir o Estoque. <br>" . $error->getMessage();

        }
    }
}


?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Registro de Estoque</h3>

    <?php if ($erro):  ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">
        <div class="form-group">
            <label for="loja" class="form-label">Loja: </label>
            <select class="form-select" name="loja_id" id="loja">
                <?php foreach ($lojas as $loja): ?>
                    <option value="<?= $loja['id'] ?>"> <?= $loja['nome'] ?? '' ?> </option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="form-group">
            <label for="produto_id" class="form-label">Produto: </label>
            <select class="form-select" name="produto_id" id="produto">
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['nome'] ?>"><?= $produto['nome'] ?? '' ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="estoque" class="form-label">Estoque: </label>
            <input type="number" class="form-control" id="estoque" name="estoque" min="0" required>
        </div>
        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>