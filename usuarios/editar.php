<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php'; 



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Usuário</h3>

    <form action="" method="post" class="w-75 mx-auto">

        <input type="hidden" name="id" value="ID do usuário...">

        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="Nome do usuário...">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email: </label>
            <input type="email" class="form-control" id="email" name="email" value="Email do usuario">
        </div>

        <div class="form-group">
            <label for="senha" class="form-label">Senha: </label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Preencha apenas se for alterar a Senha">
        </div>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>