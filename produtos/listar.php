<?php 

session_start();
require_once __DIR__ . '/../config.php';
$titulo = "Produtos |";
require_once BASE_PATH . '/includes/cabecalho.php'; 
require_once BASE_PATH .'/src/produtos_crud.php';
require_once BASE_PATH .'/src/utils.php';

exigirLogin();

$termoBusca = sanitizar($_GET['buscar'] ?? '', 'texto') ?? null;

$erro = null;
$erroValidacaoBusca = null;
$produtos = [];

if(isset($_GET['buscar']) && empty($termoBusca)){
    $erroValidacaoBusca = "O termo de busca não pode ser vazio.";
}

try {
    $produtos = buscarProduto($conexao, $termoBusca);
} catch (Throwable $error) {
    $erro = "Erro ao buscar o produto <br>" . $error->getMessage();
}

?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-box-fill"></i> Produtos</h3>
    <p>
        <a  class="btn btn-primary" href="inserir.php">
           <i class="bi bi-plus-circle"></i> Adicionar novo produto
        </a>
    </p>

    <?php if($erro):  ?>
        <p class="alert alert-danger text-center"><?=$erro ?></p>
    <?php endif; ?>
    <?php if($erroValidacaoBusca):  ?>
        <p class="alert alert-danger text-center"><?=$erroValidacaoBusca ?></p>
    <?php endif; ?>

    <form action="" method="get" class="mx-auto my-4">
        <div class="row  g-2 justify-content-center mb-3">
            <div class="col-auto">
                <input  required id = "buscar" type="buscar" name="buscar" class="form-control" placeholder="Buscar produto..." value="<?=$termoBusca?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>
    </form>

        <?php 
            $mensagem = "";

            if($termoBusca !== ""):
                if(!empty($produtos)):
                    $mensagem = "<p class='text-muted'>Resultados para <b class = 'bg-info-subtle rounded p-1'>$termoBusca</b></p>";  
                else:
                    $mensagem = "<p class = 'text-danger'>Nenhum produto foi encontrado</p>";
                endif;   

                echo $mensagem;
        ?>
            <a href="listar.php" class="btn btn-sm btn-outline-secondary">&times;Limpar Busca</a>
            
        <?php endif; ?>
      
        

        

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: <?= count($produtos) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th >Nome</th>
                    <th>Descrição</th>
                    <th>Fornecedor</th>
                    <th>Preço</th>
                    <th>Data de Validade</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
 <?php foreach($produtos as $produto): ?>               
                <tr>
                    <td ><?= $produto['nome'] ?></td>
                    <td ><?= $produto['descricao'] ?></td>
                    <td ><?= $produto['fornecedor'] ?></td>
                    <td ><?= formatarPreco($produto['preco']) ?></td>
                    <td ><?= formatarData($produto['data_validade']) ?></td>
                    <td ><a href="editar.php" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a></td>
                    <td ><a href="excluir.php" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a></td>
                </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>