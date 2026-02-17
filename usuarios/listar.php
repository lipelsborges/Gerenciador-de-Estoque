<?php 

require_once __DIR__ . '/../config.php';
require_once BASE_PATH . "/src/usuario_crud.php";

$erro = null;
$usuarios = [];

try {

    $usuarios = buscarUsuario($conexao);

} catch (Throwable $error) {
    $erro = "Erro ao buscar usuários. Detalhes: <br>". $error->getMessage();
}




$titulo = "Usuários |";
require_once BASE_PATH . '/includes/cabecalho.php'; 


?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-person-circle"></i> Usuários</h3>

    <?php if($erro):  ?>
    <p class="alert alert-danger text-center"><?=$erro ?></p>
    <?php endif; ?>

    <p>
        <a  class="btn btn-primary" href="inserir.php">
           <i class="bi bi-plus-circle"></i> Adicionar Novo Usuário
        </a>
    </p>

    <form action="" method="get" class="mx-auto my-4">
        <div class="row  g-2 justify-content-center mb-3">
            <div class="col-auto">
                <input  type="search" name="search" class="form-control" placeholder="Buscar loja...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: <?= count($usuarios) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th >Id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
<?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td ><?=$usuario['id'] ?></td>
                    <td ><?= $usuario['nome'] ?></td>
                    <td ><?= $usuario['email'] ?></td>
                    <td ><a href="editar.php?id=<?=$usuario['id']?>"  class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a></td>
                    <td ><a href="excluir.php" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a></td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>