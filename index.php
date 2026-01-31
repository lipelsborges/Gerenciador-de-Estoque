<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Gerenciamento de estoque</title>
    <link rel="shortcut icon" href="images/coruja.png" type="image/x-icon" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <header class="border-bottom border-primary-subtle bg-body">
        <div class="container">
            <div class="row align-items-center py-2 justify-contente-between">
                <div class="col-4">
                    <h1 class="fs-4" ><a class="text-decoration-none" href="index.php">Fly by Day</a></h1>
                    <h2 class="fs-6 lead">Gerenciamento de estoque</h2>
                </div>
                <div class="col-8">
                    <nav>
                        <ul class="nav justify-content-end">
                            <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-fill"></i> Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="fornecedores/listar.php"><i class="bi bi-people-fill"></i> Fornecedores</a></li>
                            <li class="nav-item"><a class="nav-link" href="produtos/listar.php"><i class="bi bi-box-fill"></i> Produtos</a></li>
                            <li class="nav-item"><a class="nav-link" href="lojas/listar.php"><i class="bi bi-tags-fill"></i> Lojas</a></li>
                            <li class="nav-item"><a class="nav-link" href="estoque/listar.php"><i class="bi bi-stack"></i> Estoque</a></li>
                        </ul>
                    </nav>
                </div>
    </header>

    <main class="container my-4">
        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h3><i class="bi bi-journal-check fs-4"></i> Resumo</h3>
            <div class="row">

                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Produtos cadastrados</b></p>

                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Fornecedores</b></p>

                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Lojas ativas</b></p>

                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Lojas sem estoque</b></p>

                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Estoque < 5</b></p>

                </div>
                <div class="col-6 col-md-4">
                    <h4><span class="badge text-bg-primary">0</span></h4>
                    <p><b>Produtos vencidos ou vencendo em até 30 dias</b></p>

                </div>
                
            </div>
        </section>
        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h3><i class="bi bi-file-earmark-text fs-4"></i> Relatórios</h3>
            <a href="relatorios/produtos-por-loja.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-box-seam"></i> Produtos por Loja</a>
            <a href="relatorios/produtos-por-fornecedor.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-people"></i> Produtos por Fornecedor</a>
            <a href="relatorios/estoque-por-produto.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-clipboard-data"></i> Estoque por Produto</a>
            <a href="relatorios/estoque-baixo.php" class="btn btn-lg btn-outline-primary my-1"><i class="bi bi-exclamation-triangle"></i> Estoque Baixo</a>
        </section>
    </main>

    
    <script src="js/bootstrap.bundle.min.js"></script>
    
</body>
</html>