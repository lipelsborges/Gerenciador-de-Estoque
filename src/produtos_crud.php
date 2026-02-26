<?php


function buscarProduto(PDO $conexao, string $busca = ''): array {

    $sql = 'SELECT 
            pr.nome,
            pr.descricao,
            f.nome "fornecedor",
            pr.preco,
            dpr.data_validade
        FROM sys.produtos pr
        LEFT JOIN fornecedores f on f.id = pr.fornecedor_id
        LEFT JOIN detalhes_produto dpr on dpr.produto_id = pr.id';
    
    $parametros = [];

    if(!empty($busca)){
        
        $buscaLimpa = html_entity_decode($busca, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        $sql .= " WHERE pr.nome COLLATE utf8mb4_general_ci LIKE :busca1 
                  OR pr.descricao COLLATE utf8mb4_general_ci LIKE :busca2";
        
        $valor = "%$buscaLimpa%";
        $parametros[':busca1'] = $valor;
        $parametros[':busca2'] = $valor;
    }

   
    $sql .= " ORDER BY pr.nome ASC";
    
    $query = $conexao->prepare($sql);
    $query->execute($parametros);
    
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

