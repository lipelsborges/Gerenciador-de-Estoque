<?php


function buscarProduto(PDO $conexao): array {

    $sql = 'SELECT 
	        pr.nome,
            pr.descricao,
            f.nome "Nome_Fornecedor",
            pr.preco,
            dpr.data_validade
        FROM sys.produtos pr
        INNER JOIN fornecedores f on f.id = pr.fornecedor_id
        INNER JOIN detalhes_produto dpr on dpr.produto_id = pr.id
        ORDER BY nome ASC';

    $query = $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}
