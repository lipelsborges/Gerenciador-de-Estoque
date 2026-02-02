<?php
    require_once __DIR__ . '/../config.php';

?>

<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <title><?=$titulo ?? ''?> Fly By Day - Gerenciamento de estoque</title>
    <link rel="shortcut icon" href="<?= BASE_URL ?>/images/coruja.png" type="image/x-icon" type="image/png">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="border-bottom border-primary-subtle bg-body">
        <div class="container">
            <div class="row align-items-center py-2 justify-contente-between">
                <div class="col-4">
                    <h1 class="fs-4"><a class="text-decoration-none" href="<?= BASE_URL ?>/index.php">Fly By Day</a></h1>
                    <h2 class="fs-6 lead">Gerenciamento de estoque</h2>
                </div>
                <div class="col-8">
                    <nav>
                        <ul class="nav justify-content-end">
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/index.php"><i class="bi bi-house-fill"></i> Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/fornecedores/listar.php"><i class="bi bi-people-fill"></i> Fornecedores</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/produtos/listar.php"><i class="bi bi-box-fill"></i> Produtos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/lojas/listar.php"><i class="bi bi-tags-fill"></i> Lojas</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>/estoque/listar.php"><i class="bi bi-stack"></i> Estoque</a></li>
                        </ul>
                    </nav>
                </div>
    </header>

    <main class="container my-4">