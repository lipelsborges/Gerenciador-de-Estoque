<?php 

require_once __DIR__ . '/../config.php';
$titulo = "Produtos por Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php'; 

exigirLogin();


?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-box-seam"></i> Produtos por Fornecedor</h3>

    <form action="" method="get" class="mx-auto my-4">

        <div class="row g-2 justify-content-center">

          <div class="col-auto">
            <label for="fornecedor_id" class="text-muted col-form-label">Selecione o Fornecedor:</label>
          </div>  

          <div class="col-auto">

            <select name="fornecedor_id" id="fornecedor_id" class="form-select">
                <option value="">-- Selecione --</option>
                <option value="id do fornecedor...">Fornecedor de Eletrônicos</option>
            </select>

          </div>

        </div>
    </form>

    <p class="fw-semibold">Produtos fornecidos pelo fornecedor selecionado: </p>
 

    <div class="table-responsive">
        <table class="table table-hover caption-top">
            <caption>Quantidade de registros: 0</caption>
            <thead class="align-middle table-light">
                <tr>
                    <th >Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td >Nome do produto..</td>
                    <td>Descrição do produto...</td>
                    <td >preço do produto....</td>
                    <td >Quantidade do produto...</td>
                    <td >Total do produto...</td>

                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>