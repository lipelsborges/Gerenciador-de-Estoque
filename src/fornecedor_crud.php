<?php 

function buscarFornecedor(PDO $conexao): array {
    $sql = "SELECT id, nome FROM fornecedores ORDER BY id";

    $query= $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}




?>