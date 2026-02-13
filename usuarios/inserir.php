<?php 

require_once __DIR__ . '/../config.php';

    $erro = null;
    $msg_success = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senhaForm = $_POST['senha'];

        if(empty($nome) || empty($email) || empty($senhaForm)){
            $erro = "Preencha todos os campos!";
        } else {
            $msg_success = "Usuário adicionado!";
        }
    }

$titulo = "Adicionar Usuário |";

require_once BASE_PATH . '/includes/cabecalho.php'; 



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Usuário</h3>

    <form action="" method="post" class="w-75 mx-auto">

        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" >
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email: </label>
            <input type="email" class="form-control" id="email" name="email" >
        </div>

        <div class="form-group">
            <label for="senha" class="form-label">Senha: </label>
            <input type="password" class="form-control" id="senha" name="senha" >
        </div>

    <?php if($erro):  ?>
        <br><p class="alert alert-danger text-center"><?=$erro ?></p>
    <?php endif; ?>

    <?php if($msg_success): ?>
        <br><p class="alert alert-success text-center"><?=$msg_success?></p>
    <?php endif; ?>

        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i>  Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>