<?php
require_once __DIR__ . '/config.php';

$titulo = "Login |";
include_once BASE_PATH . '/includes/cabecalho.php';
?>





<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h1 class="mb-2">FLY BY DAY</h1>
    <h2 class="fs-6 lead">Gerenciamento de Estoque</h2>

    <hr>
    <h3>Login</h3>
    <p class="lead">Entre com seu e-email e senha para acessar o sistema. </p>

    <form action="" method="post" class="w-50 mx-auto text-start mt-3">

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>

    </form>
    
</section>






<?php
include_once BASE_PATH . '/includes/rodape.php';
?>