<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Produtos |";
require_once BASE_PATH . '/includes/cabecalho.php'; 


?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-box-fill"></i> Produtos</h3>
    <p>
        <a  class="btn btn-primary" href="inserir.php">
           <i class="bi bi-plus-circle"></i> Adicionar novo produto
        </a>
    </p>

    <form action="" method="get" class="mx-auto my-4">
        <div class="row  g-2 justify-content-center mb-3">
            <div class="col-auto">
                <input  type="search" name="search" class="form-control" placeholder="Buscar produto...">
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
            <caption>Quantidade de registros: 0</caption>
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
                <tr>
                    <td >Ultrabook</td>
                    <td >Equipamento de última geração</td>
                    <td >Asus</td>
                    <td >R$ 3.499,12</td>
                    <td >2025-12-31</td>
                    <td ><a href="editar.php" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Editar</a></td>
                    <td ><a href="excluir.php" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>