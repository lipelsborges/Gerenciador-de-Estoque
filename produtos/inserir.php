<?php

require_once __DIR__ . '/../config.php';
$titulo = "Adicionar Produto |";
require_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/produtos_crud.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';
require_once BASE_PATH . '/src/utils.php';

exigirLogin();
$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produto = [
        'nome' => sanitizar($_POST['nome'], 'texto'),
        'descricao' => sanitizar($_POST['descricao'], 'texto') ?: null,
        'preco' => sanitizar($_POST['preco'], 'float'),
        'quantidade' => sanitizar($_POST['quantidade'], 'inteiro'),
        'fornecedor_id' => sanitizar($_POST['fornecedor_id'], 'inteiro'),
    ];

    $detalhes = [
        'peso' => sanitizar($_POST['peso'], 'float') ?: null,
        'dimensoes' => sanitizar($_POST['dimensoes'], 'dimensao') ?: null,
        'codigo_barras' => sanitizar($_POST['codigo_barras']) ?: null,
        'data_validade' => sanitizar($_POST['data_validade'], 'data') ?: null,
    ];
    if (empty($produto['nome'])) {
        $erros[] = "O nome é obrigatório";
    }

    if (empty($produto['fornecedor_id'])) {
        $erros[] = "Escolha um fornecedor";
    }

    // -------------------------------------------------

    if (trim($_POST['preco']) === '') {
        $erros[] = "O preço é obrigatório";
    } elseif ($produto['preco'] < 0) {
        $erros[] = "Informe um preço válido";
    }

    if (trim($_POST['quantidade']) === '') {
        $erros[] = "A quantidade é obrigatório";
    } elseif ($produto['quantidade'] < 0) {
        $erros[] = "Informe uma quantidade válida";
    }

    if(empty($erros)){
        try {
            //Iniciamos uma transação cujas operações serão feitas de forma agrupada
            $conexao->beginTransaction();

            $produto_id = inserirProduto($conexao, $produto);

            if($detalhes['peso'] || $detalhes['dimensoes'] || $detalhes['codigo_barras'] || $detalhes['data_validade']){
                //Adicionando o ID do novo produto aos detalhes antes de inserir o registro.
                $detalhes['produto_id'] = $produto_id;
                inserirDetalhesDoProduto($conexao, $detalhes);
            }
            //Commit aplica/conclui as operações da transação
            $conexao->commit();

            header("location:listar.php");
            exit;

        } catch (Throwable $erro) {
            //Se algo deu errado, desfaz as alterações.
            $conexao->rollBack();

            if($erro->getCode() === '23000'){
                $erros[] = "O código de barras já existe no sistema.";
            }else{
                 $erros[] = "Erro ao inserir produto: <br>". $erro->getMessage();
            }


           
            
        }
    }
}



?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Produto</h3>

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
        <h4>Produto</h4>
        <div class="form-group">
            <label for="nome" class="form-label">Nome: </label>
            <input required value="<?= $_POST['nome'] ?? '' ?>" type="text" class="form-control" id="nome" name="nome">

            <label for="descricao" class="form-label mt-2">Descrição: </label>
            <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= $_POST['descricao'] ?? '' ?></textarea>

            <label for="preco" class="form-label mt-2">Preço: </label>
            <input required value="<?= $_POST['preco'] ?? '' ?>" type="number" step="0.01" class="form-control" id="preco" name="preco">

            <label for="quantidade" class="form-label mt-2">Quantidade: </label>
            <input required <?= $_POST['quantidade'] ?? '' ?> type="number" class="form-control" id="quantidade" name="quantidade" min="0">

            <label for="fornecedor_id" class="form-label">Fornecedor: </label>
            <select required name="fornecedor_id" id="fornecedor_id" class="form-select">
                <option value=""><strong>Selecione um Fornecedor</strong></option>
                <?php $fornecedores = buscarFornecedor($conexao);
                foreach ($fornecedores as $fornecedor):

                    /* Se o ID do fornecedor atual no loop for o mesmo que foi enviado no formulario
                            entao guardamos o atributo selected na variavel selecionada*/
                    $selecionado = (isset($_POST['fornecedor_id']) && $_POST['fornecedor_id'] == $fornecedor['id']) ? 'selected' : '';
                ?>
                    <option <?= $selecionado ?> value="<?= $fornecedor['id'] ?>"><?= $fornecedor['nome'] ?></option>

                    <?php endforeach; ?>
            </select>

        </div><br>
        <h4>Detalhe do Produto</h4>
        <div class="form-group">
            <label for="detalhes" class="form-label">Peso(kg): </label>
            <input value="<?= $_POST['peso'] ?? '' ?>" type="number" step="0.01" class="form-control" id="peso" name="peso">

            <label for="detalhes" class="form-label mt-2">Dimensões (LxAxP): </label>
            <input value="<?= $_POST['dimensoes'] ?? '' ?>" type="text" class="form-control" id="dimensoes" name="dimensoes">

            <label for="codigo_barras" class="form-label mt-2">Código de Barras: </label>
            <input value="<?= $_POST['codigo_barras'] ?? '' ?>" type="text" class="form-control" id="codigo_barras" name="codigo_barras">

            <label for="data_validade" class="form-label mt-2">Data de Validade: </label>
            <input value="<?= $_POST['data_validade'] ?? '' ?>" type="date" class="form-control" id="data_validade" name="data_validade">

        </div>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>

</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>