<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Editar Produto |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH .'/src/fornecedor_crud.php';
require_once BASE_PATH . '/src/produtos_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();

$id = sanitizar($_GET['id'], 'inteiro');
$erro = [];

if(!$id){
    header('location:listar.php');
    exit;
}

try {

    
    $produto = buscarProdutoPorId($conexao, $id);
    if (!$produto) $erro[]= "Produto não encontrado!";
    

} catch (Throwable $error) {

$erro[] = "Erro ao buscar produto<br>". $error->getMessage();
    
}




?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Produto</h3>

    <?php if (!empty($erros)): ?>
        <div class="text-center">
            <ul class="list-group">
                <?php foreach ($erros as $erro): ?>
                    <li class="list-group-item list-group-item-danger"><?= $erro ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

    <?php endif; ?>

    <form action="" method="post" class="w-75 mx-auto">

        <legend>Produto</legend>
        
        <input type="hidden" name="detalhe_id" value="<?=$produto['detalhe_id'] ?? '' ?>">
        <input type="hidden" name="id" value="<?=$produto['produto_id'] ?? '' ?>">

        <div class="form-group">

            <label for="nome" class="form-label">Nome: </label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $produto['nome'] ?>">

            <label for="descricao" class="form-label">Descrição: </label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $produto['descricao'] ?>">

            <label for="fornecedor" class="form-label">Fornecedor: </label>
            <select class="form-select" id="fornecedor" name="fornecedor">

                <option value=""></option>

                <?php  

                    $fornecedores = buscarFornecedor($conexao);
                    foreach($fornecedores as $fornecedor):
                        
                    $selecionado = ($fornecedor['id'] === $produto['fornecedor_id']) ? 'selected' : '';
                ?>
                <option value="<?= $fornecedor['id'] ?>" <?= $selecionado ?>><?= $fornecedor['nome'] ?></option>
                <?php  
                
                    endforeach;

                ?>


            </select>

            <label for="preco" class="form-label">Preço: </label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= $produto['preco'] ?>">


            <label for="quantidade" class="form-label">Quantidade: </label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" min="0" value="<?= $produto['quantidade']?>">


            <h4 class="mt-4">Detalhe do Produto</h4>


            <label for="detalhes" class="form-label">Peso(kg): </label>
            <input type="number" step="0.01" class="form-control" id="peso" name="peso" value="<?= $produto['peso'] ?? '' ?>"> 



            <label for="detalhes" class="form-label mt-2">Dimensões (LxAxP): </label>
            <input type="text" class="form-control" id="dimensoes" name="dimensoes" value="<?= $produto['dimensoes'] ?? ''?>">



            <label for="codigo_barras" class="form-label mt-2">Código de Barras: </label>
            <input type="text" class="form-control" id="codigo_barras" name="codigo_barras" value="<?= $produto['codigo_barras'] ?? ''?>">



            <label for="data_validade" class="form-label">Data de Validade: </label>
            <input type="date" class="form-control" id="data_validade" name="data_validade" value="<?= $produto['data_validade'] ?? '' ?>">
            

            
        </div>
        <a href="<?= BASE_URL ?>/produtos/listar.php" class="btn btn-secondary my-4"><i class="bi bi-arrow-left"></i> Voltar</a>
        <button type="submit" class="btn btn-warning my-4"><i class="bi bi-arrow-clockwise"></i>  Salvar Alterações</button>
        
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>