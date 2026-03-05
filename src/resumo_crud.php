<?php

function contarProdutos(PDO $conexao): int{

    $sql = "SELECT COUNT(*) FROM produtos";
    return (int)$conexao->query($sql)->fetchColumn();
}

function contarFornecedor(PDO $conexao): int {
    $sql = "SELECT COUNT(*) FROM fornecedores";
    return (int)$conexao->query($sql)->fetchColumn();
}

function contarLojas(PDO $conexao): int {
    $sql = "SELECT COUNT(*) FROM lojas";
    return (int)$conexao->query($sql)->fetchColumn();
}

function contarEstoqueBaixo(PDO $conexao): int {
    $sql = "SELECT COUNT(*) FROM lojas_produtos WHERE estoque < 5";
    return (int)$conexao->query($sql)->fetchColumn();
}

function contarLojasSemRegistroDeEstoque(PDO $conexao): int{;
    $sql = "SELECT COUNT(*) FROM lojas l
            LEFT JOIN lojas_produtos lp ON l.id = lp.loja_id
            WHERE lp.loja_id IS NULL  ";
    return (int)$conexao->query($sql)->fetchColumn();
}