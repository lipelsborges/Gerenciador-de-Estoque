<?php

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = sanitizar($_POST['nome'], 'texto');

    if (empty($nome)) {

        $erro = 'Preencha o campo nome!';

    } else {

        try {

            inserirFornecedor($conexao, $nome);
            header('location:listar.php');

        } catch (Throwable $error) {

            $erro = "Erro ao inserir o Fornecedor. <br>" . $error->getMessage();

        }
    }
}





?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Fornecedor</h3>

    <?php if($erro):  ?>
        <br><p class="alert alert-danger text-center "><strong><?=$erro ?></strong></p>
    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $_POST['nome'] ?? ''?>">
        </div>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>