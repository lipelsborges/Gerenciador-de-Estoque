 <?php

 function buscarEstoque(PDO $conexao): array {


    $sql = "SELECT 
	    l.nome 'Nome_loja',
        pr.nome 'Nome_Produto',
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

    $sql = 'INSERT INTO sys.lojas_produtos (Nome_loja, Nome_Produto, estoque)
    VALUES (:Nome_loja, :Nome_Produto, :estoque)';

    $query = $conexao->prepare($sql);
    $query->bindValue(':Nome_loja', $nomeL);
    $query->bindValue(':Nome_Produto', $nomeP);
    $query->bindValue(':estoque', $estoque);
    $query->execute();

}