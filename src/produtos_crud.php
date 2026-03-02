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

function inserirProduto(PDO $conexao, array $produto): int{

    $sql = "INSERT INTO produtos(nome, descricao, preco, quantidade, fornecedor_id)
            VALUES(:nome, :descricao, :preco, :quantidade, :fornecedor_id)";
    $query = $conexao->prepare($sql);
    $query->bindValue(":nome", $produto['nome'], PDO::PARAM_STR);
    $query->bindValue(":descricao", $produto['descricao']
                      , is_null($produto['descricao']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $query->bindValue(":preco", $produto['preco'], PDO::PARAM_STR);
    $query->bindValue(":quantidade", $produto['quantidade'], PDO::PARAM_INT);
    $query->bindValue(":fornecedor_id", $produto['fornecedor_id'], PDO::PARAM_INT);

    $query->execute();
    // Retornando o ID do produto recém-inserido
   return (int) $conexao->lastInsertId();
}

function inserirDetalhesDoProduto(PDO $conexao, array $detalhes):void {

    $sql = "INSERT INTO detalhes_produto(produto_id, peso, dimensoes, codigo_barras, data_validade)
            VALUES(:produto_id, :peso, :dimensoes, :codigo_barras, :data_validade)";
    $query= $conexao->prepare($sql);
    $query->bindValue(":produto_id", $detalhes['produto_id'], PDO::PARAM_STR);

    $query->bindValue(":peso", $detalhes['peso'], is_null($detalhes['peso']) ? PDO::PARAM_NULL : PDO::PARAM_STR);

    $query->bindValue(":dimensoes", $detalhes['dimensoes'], is_null($detalhes['dimensoes']) ? PDO::PARAM_NULL : PDO::PARAM_STR);

    $query->bindValue(":codigo_barras", $detalhes['codigo_barras'], is_null($detalhes['codigo_barras']) ? PDO::PARAM_NULL : PDO::PARAM_STR);

    $query->bindValue(":data_validade", $detalhes['data_validade'], is_null($detalhes['data_validade']) ? PDO::PARAM_NULL : PDO::PARAM_STR);
    $query->execute();
}