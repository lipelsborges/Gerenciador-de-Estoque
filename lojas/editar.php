<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Lojas |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH . '/src/lojas_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();

$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;

if (!$id) {
    header('location:listar.php');
    exit;
}

try {

    $lojas = buscarLojaPorId($conexao, $id);
    if(!$lojas)  $erro = "Loja não encontrado";


} catch (Throwable $error) {

    $erro = "Erro ao buscar Loja<br>". $error->getMessage();
    
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nome = sanitizar($_POST['nome'], 'texto');

    if (empty($nome)) {
        
        $erro = "Nome é obrigatório!";

    } else {

        try {

            atualizarLoja($conexao, $id, $nome);


            header('location:listar.php');
            

            exit;
        } catch (Throwable $error) {

            $erro = 'Erro ao atualizar fornecedor: <br>' . $error->getMessage();

        }
    }
}


?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Loja</h3>

    <?php if ($erro):  ?>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">
        <input type="hidden" name="id" value="<?= $lojas['id'] ?? ''?>">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $lojas['nome'] ?? ''?>">
        </div>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>