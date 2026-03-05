 <?php

 function buscarEstoque(PDO $conexao): array {


    $sql = "SELECT 
        lp.loja_id,
        lp.produto_id,
	    l.nome 'nome_loja' ,
        pr.nome 'nome_produto',
	    lp.estoque
    FROM sys.lojas_produtos lp
    INNER JOIN lojas l ON l.id = lp.loja_id
    INNER JOIN produtos pr ON pr.id = lp.produto_id
    ORDER BY l.nome ASC";

    $query = $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

 }

function inserirEstoque($conexao, int $loja_id, int $produto_id, int $estoque):void {


    $sql = 'INSERT INTO sys.lojas_produtos (loja_id, produto_id, estoque)
    VALUES (:loja_id, :produto_id, :estoque)';

    $query = $conexao->prepare($sql);
    $query->bindValue(':loja_id', $loja_id);
    $query->bindValue(':produto_id', $produto_id);
    $query->bindValue(':estoque', $estoque);
    $query->execute();

}

function buscarEstoquePorIds($conexao, $loja_id, $produto_id): ?array {

    $sql = "SELECT
                lp.loja_id, 
                lp.produto_id, 
                lp.estoque,
                l.nome 'nome_loja', 
                pr.nome 'nome_produto'
            FROM lojas_produtos lp
            INNER JOIN lojas l on lp.loja_id = l.id
            INNER JOIN produtos pr on lp.produto_id= pr.id
            WHERE lp.loja_id = :loja_id AND lp.produto_id = :produto_id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':loja_id', $loja_id, PDO::PARAM_INT);
    $query->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    return $resultado ?: null;
}

function atualizarEstoque($conexao, $loja_id, $produto_id, $estoque): void {

    $sql = "UPDATE lojas_produtos SET estoque = :estoque WHERE loja_id = :loja_id AND produto_id = :produto_id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':estoque', $estoque, PDO::PARAM_INT);
    $query->bindValue(':loja_id', $loja_id, PDO::PARAM_INT);
    $query->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
    $query->execute();

}

function excluirEstoque($conexao, $loja_id, $produto_id): void {

    $sql = "DELETE FROM lojas_produtos WHERE loja_id = :loja_id AND produto_id = :produto_id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':loja_id', $loja_id, PDO::PARAM_INT);
    $query->bindValue(':produto_id', $produto_id, PDO::PARAM_INT);
    $query->execute();

}