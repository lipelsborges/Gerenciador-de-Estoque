<?php
session_start();
require_once __DIR__ . '/../config.php';
$titulo = "Editar Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';
require_once BASE_PATH . '/src/utils.php';


exigirLogin();

$id = sanitizar($_GET['id'], 'inteiro');
$sucess = null;
$erro = null;

if (!$id) {
    header('location:listar.php');
    exit;
}

try {

    $fornecedor = buscarFornecedorPorId($conexao, $id);
    if (!$usuario) $erro = "Fornecedor não encontrado!";
    

} catch (Throwable $error) {
    $erro = "Erro ao buscar fornecedor <br>" . $error->getMessage();

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nome = sanitizar($_POST['nome'], 'texto');

    if (empty($nome)) {
        
        $erro = "Nome é obrigatório!";

    } else {

        try {

            atualizarFornecedor($conexao, $id, $nome);

            $_SESSION['sucesso'] = '<strong>Fornecedor editado com sucesso!</strong>';

            header('location:listar.php');
            

            exit;
        } catch (Throwable $error) {

            $erro = 'Erro ao atualizar fornecedor: <br>' . $error->getMessage();

        }
    }
}



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Fornecedor</h3>

    <?php if ($erro):  ?>
        <br>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php endif; ?>
    <?php if ($sucess):  ?>
        <br>
        <p class="alert alert-danger text-center"><?= $sucess ?></p>
    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">
        <input type="hidden" name="id" value="Id do fornecedor">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $fornecedor['nome'] ?>">
        </div>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i> Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>