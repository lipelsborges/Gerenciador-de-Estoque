<?php

require_once __DIR__ . '/config.php';

exigirLogin();

include_once BASE_PATH . '/includes/cabecalho.php';
require_once BASE_PATH . '/src/resumo_crud.php';
require_once BASE_PATH . '/src/utils.php';


$erro = null;

$totalFornecedor = contarFornecedor($conexao);
$totalProdutos = contarProdutos($conexao);
$totalLojas = contarLojas($conexao);
$totalEstoqueBaixo = contarEstoqueBaixo($conexao);
$totalLojaSemRegistroDeEstoque = contarLojasSemRegistroDeEstoque($conexao);
$totalProdutosVencidosOuVencendo = contarProdutosVencidosOVencendo($conexao);



?>

<?php if($totalProdutosVencidosOuVencendo > 0): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle"></i><strong> Atenção!</strong> <?= $totalProdutosVencidosOuVencendo ?> produto(s) vencido(s) ou perto do vencimento!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-journal-check fs-4"></i> Resumo</h3>
    <div class="row">

        <div class="col-6 col-md-4">
            <h4><span class="badge text-bg-primary"><?= $totalProdutos ?></span></h4>
            <p><b>Produtos cadastrados</b></p>

        </div>
        <div class="col-6 col-md-4">
            <h4><span class="badge text-bg-primary"><?= $totalFornecedor ?></span></h4>
            <p><b>Fornecedores</b></p>

        </div>
        <div class="col-6 col-md-4">
            <h4><span class="badge text-bg-primary"><?= $totalLojas ?></span></h4>
            <p><b>Lojas ativas</b></p>

        </div>
        <div class="col-6 col-md-4">
            <?php $classeLojas = $totalLojaSemRegistroDeEstoque > 0 ? 'danger' : 'success' ?>
            <h4><span class="badge text-bg-<?= $classeLojas ?>"><?= $totalLojaSemRegistroDeEstoque ?></span></h4>
            <p><b>Lojas sem registro de estoque</b></p>

        </div>
        <div class="col-6 col-md-4">
            <?php $classeEstoque = $totalEstoqueBaixo > 5 ? 'warning' : 'success' ?>
            <h4><span class="badge text-bg-<?= $classeEstoque ?>"><?= $totalEstoqueBaixo ?></span></h4>
            <p><b>Estoque < 5</b>
            </p>

        </div>
        <div class="col-6 col-md-4">
            <?php $classeVencidos = $totalProdutosVencidosOuVencendo > 0 ? 'danger' : 'success' ?>
            <h4><span class="badge text-bg-<?= $classeVencidos ?>"><?= $totalProdutosVencidosOuVencendo ?></span></h4>
            <p><b>Produtos vencidos ou vencendo em até 30 dias</b></p>

        </div>

        <p class="text-muted small text-end mt-3">
           📅 Consulta feita em: <time datetime="<?=date("c")?>"> <?= ultimaAtualizacao() ?></time>
        </p>

    </div>
</section>
<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-file-earmark-text fs-4"></i> Relatórios</h3>
    <a href="<?= BASE_URL ?>/relatorios/produtos-por-loja.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-box-seam"></i> Produtos por Loja</a>
    <a href="<?= BASE_URL ?>/relatorios/produtos-por-fornecedor.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-people"></i> Produtos por Fornecedor</a>
    <a href="<?= BASE_URL ?>/relatorios/estoque-por-produto.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-clipboard-data"></i> Estoque por Produto</a>
    <a href="<?= BASE_URL ?>/relatorios/estoque-baixo.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-exclamation-triangle"></i> Estoque Baixo</a>
</section>

<?php


include_once BASE_PATH . '/includes/rodape.php';
?>