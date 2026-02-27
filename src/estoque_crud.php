 <?php

 function buscarEstoque(PDO $conexao): array {


    $sql = "SELECT 
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

function inserirEstoque($conexao, $nomeL, $nomeP, $estoque):void {


    $sql = 'INSERT INTO sys.lojas_produtos (nome_loja, nome_produto, estoque)
    VALUES (:nome_loja, :nome_produto, :estoque)';

    $query = $conexao->prepare($sql);
    $query->bindValue(':nome_loja', $nomeL);
    $query->bindValue(':nome_produto', $nomeP);
    $query->bindValue(':estoque', $estoque);
    $query->execute();

}