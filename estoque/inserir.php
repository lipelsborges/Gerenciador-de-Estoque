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
    $loja_id = sanitizar($_POST['loja_id'], 'inteiro');
    $produto_id = sanitizar($_POST['produto_id'], 'inteiro');
    $estoque = sanitizar($_POST['estoque'], 'inteiro');

    if ($loja_id && $produto_id) {

        try{
            inserirEstoque($conexao, $loja_id, $produto_id, $estoque);
            header('location:listar.php');
            exit;
        }catch(PDOException $error){

           $codigoErro =  $error->errorInfo[1] ?? null;
           if($codigoErro === 1062){
                $erro = "Este produto já está cadastrado no estoque desta loja.";
           }elseif($codigoErro === 4025){
                $erro = "O estoque não pode ser negativo.";
           } else {
                $erro = "Erro ao inserir os dados.". $error->getMessage();
           }

        } catch (Throwable $error) {
            
            $erro = "Erro inesperado. <br>" . $error->getMessage();

        }
    } else {
        $erro = "Por favor, preencha todos os campos. ";
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
            <select required class="form-select" name="loja_id" id="loja">
                <option value="">Selecione a loja</option>
                <?php foreach ($lojas as $loja): ?>
                    <option value="<?= $loja['id'] ?>"> <?= $loja['nome'] ?? '' ?> </option>
                <?php endforeach; ?>
            </select>

        </div>
        <div class="form-group">
            <label for="produto_id" class="form-label">Produto: </label>
            <select required class="form-select" name="produto_id" id="produto">
                <option value="">Selecione o Produto</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>"><?= $produto['nome'] ?? '' ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="estoque" class="form-label">Estoque: </label>
            <input value="<?= $_POST['estoque'] ?? 0 ?>" type="number" class="form-control" id="estoque" name="estoque" min="0" required>
        </div>
        <a href="listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>