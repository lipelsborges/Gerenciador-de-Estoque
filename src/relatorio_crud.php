<?php

function buscarProdutoPorLoja(PDO $conexao, int $loja_id): array
{

    $sql = "SELECT 
                p.nome 'produto', 
                p.preco, 
                f.nome 'fornecedor',
                lp.estoque,
                lp.loja_id,
                lp.produto_id
            FROM lojas_produtos lp
            JOIN produtos p ON lp.produto_id = p.id
            JOIN fornecedores f ON p.fornecedor_id = f.id
            WHERE lp.loja_id = :loja_id
            ORDER BY p.nome";

    $query = $conexao->prepare($sql);
    $query->bindParam(':loja_id', $loja_id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscarProdutoPorFornecedor(PDO $conexao, int $fornecedor_id): array
{

    $sql = "SELECT 
                id,
                nome,
                descricao,
                preco,
                quantidade,
                preco * quantidade 'total'
            FROM produtos
            WHERE fornecedor_id = :fornecedor_id
            ORDER BY nome";
    
    $query = $conexao->prepare($sql);
    $query->bindParam(':fornecedor_id', $fornecedor_id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscarEstoquePorProduto(PDO $conexao, int $produto_id): array
{

    $sql = "SELECT 
                l.nome 'loja',
                lp.estoque,
                lp.produto_id,
                lp.loja_id
            FROM lojas_produtos lp
            JOIN lojas l ON lp.loja_id = l.id
            WHERE lp.produto_id = :produto_id
            ORDER BY l.nome";

    $query = $conexao->prepare($sql);
    $query->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);

}

function buscarProdutosComEstoqueBaixo(PDO $conexao, int $limite):array
{
    $sql = "SELECT
                produtos.nome AS produto,
                lojas.nome AS loja,
                lojas_produtos.estoque AS quantidade,
                lojas_produtos.produto_id,
                lojas_produtos.loja_id
            FROM lojas_produtos
            JOIN produtos ON produtos.id = lojas_produtos.produto_id
            JOIN lojas ON lojas.id = lojas_produtos.loja_id
            WHERE lojas_produtos.estoque < :limite
            ORDER BY lojas_produtos.estoque, produtos.nome";

    $consulta = $conexao->prepare($sql);
    $consulta->bindValue(":limite", $limite, PDO::PARAM_INT);
    $consulta->execute();
    return $consulta->fetchAll(PDO::FETCH_ASSOC);
}