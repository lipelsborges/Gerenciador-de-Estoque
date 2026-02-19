<?php

require_once __DIR__ . '/../config.php';
require_once BASE_PATH . "/src/usuario_crud.php";
require_once BASE_PATH . '/src/utils.php';

exigirLogin();


$id = sanitizar($_GET['id'], 'inteiro');
$erro = null;
$sucess = null;

if (!$id) {

    header("location:listar.php");
    exit;
}

try {

    $usuario = buscarUsuarioPorId($conexao, $id);
    if (!$usuario) $erro = "Usuário não encontrado!";
    //dump($usuario);

} catch (Throwable $error) {
    $erro = "Erro ao buscar usuário <br>" . $error->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = sanitizar($_POST['nome'], 'nome');
    $email = sanitizar($_POST['email'], 'email');
    $senhaForm = $_POST['senha'];

    if (empty($nome) || empty($email)) {

        $erro = "Nome e E-mail são obrigatórios.";
    } else {

        try {

            //A Pergunta: O campo de senha no formulário ($senhaForm) veio vazio?
            //Se SIM (?): O usuário não quer mudar a senha. Então, $senhaVerificada recebe o que já está no banco ($usuario['senha']).
            //Se NÃO (:): O usuário digitou algo. Então, o código chama a função verificarSenha() para tratar esse novo dado antes de atribuí-lo à variável.

            $senhaVerificada = empty($senhaForm) ? $usuario['senha'] : verificarSenha($senhaForm, $usuario['senha']);

            atualizarUsuario($conexao, $id, $nome, $email, $senhaVerificada);

            $sucess = "Editado com sucesso! ";

            header("location:listar.php");
            
            exit;

        } catch (Throwable $error) {
            if ($error->getCode() === '23000') {

                $erro = "E-mail já cadastrado. Por favor, use outro e-mail.";
            } else {

                $erro = "Erro ao atualizar usuário: <br>" . $error->getMessage();
            }
        }
    }
}



$titulo = "Editar Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php';



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Usuário</h3>

    <?php if ($erro):  ?>
        <br>
        <p class="alert alert-danger text-center"><?= $erro ?></p>
    <?php endif; ?>




    <form action="" method="post" class="w-75 mx-auto">

        <input type="hidden" name="id" value="<?= $usuario['nome'] ?? '' ?>">

        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input required type="text" class="form-control" id="nome" name="nome" value="<?= $usuario['nome'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email: </label>
            <input required type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="senha" class="form-label">Senha: </label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Preencha apenas se for alterar a Senha">
        </div>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i> Salvar Alterações</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>