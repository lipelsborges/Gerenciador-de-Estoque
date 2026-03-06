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
