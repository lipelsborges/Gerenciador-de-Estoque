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