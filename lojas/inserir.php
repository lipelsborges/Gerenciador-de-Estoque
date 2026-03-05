<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Loja |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/lojas_crud.php';
require_once BASE_PATH . '/src/utils.php';


$erro = null;
exigirLogin();

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    $nome = sanitizar($_POST['nome'], 'texto');

    if(empty($nome)){
        
        $erro = 'Campo nome obrigatório!';
        

    } else{

        try {
            inserirLoja($conexao, $nome);
            header('location:listar.php');
            exit;

        } catch (Throwable $error) {

            $erro = "Erro ao inserir a Loja". $error->getMessage();

        }
    }
}
        


?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Loja</h3>

    <?php if($erro):  ?>
        <p class="alert alert-danger text-center "><?=$erro ?></p>
    <?php endif; ?>


    <form action="" method="post" class="w-75 mx-auto">
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input required value="<?= $_POST['nome'] ?? '' ?>" type="text" class="form-control" id="nome" name="nome">
        </div>
        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i>  Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>