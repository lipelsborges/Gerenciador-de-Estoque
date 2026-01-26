<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title>Gerenciamento de estoque</title>
    <link rel="shortcut icon" href="images/coruja.png" type="image/x-icon" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
</head>
<body>
    <header class="border-bottom border-primary-subtle bg-body">
        <div class="container">
            <div class="row align-items-center py-2 justify-contente-between">
                <div class="col-4">
                    <h1 class="fs-4">Flamengo Site</h1>
                    <h2 class="fs-6 lead">Gerenciamento de estoque</h2>
                </div>
                <div class="col-8">
                    <nav>
                        <ul class="nav justify-content-end">
                            <li class="nav-item"><a class="nav-link" href="">Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Fornecedores</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Produtos</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Lojas</a></li>
                            <li class="nav-item"><a class="nav-link" href="">Estoque</a></li>
                        </ul>
                    </nav>
                </div>
    </header>

    <main class="container my-4">
        <section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
            <h3>Resumo</h3>
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
            <h3>Relatórios</h3>
            <a href="/produtos-por-loja" class="btn btn-lg btn-outline-primary my-1">Produtos por Loja</a>
            <a href="" class="btn btn-lg btn-outline-primary my-1">Produtos por Fornecedor</a>
            <a href="" class="btn btn-lg btn-outline-primary my-1">Estoque por Produto</a>
            <a href="" class="btn btn-lg btn-outline-primary my-1">Estoque Baixo</a>
        </section>
    </main>

    
    <script src="js/bootstrap.bundle.min.js"></script>
    
</body>
</html>