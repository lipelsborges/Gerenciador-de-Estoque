<?php 

function buscarFornecedor(PDO $conexao): array {
    $sql = "SELECT * FROM fornecedores ORDER BY id";

    $query= $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}

function inserirFornecedor(PDO $conexao, $nome): void {
    $sql = "INSERT INTO fornecedores(nome)
            VALUES (:nome)";

    $query = $conexao->prepare($sql);
    $query->bindValue(':nome', $nome, PDO::PARAM_STR);
    $query->execute();

}

function excluirFornecedor(PDO $conexao, $id): void{

    $sql = "DELETE FROM fornecedores WHERE id= :id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

};

function buscarFornecedorPorId(PDO $conexao, int $id): ?array{

    $sql = "SELECT * FROM fornecedores WHERE id = :id";

    $query = $conexao->prepare($sql);
    $query-> bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $resultado =  $query->fetch(PDO::FETCH_ASSOC);
    return $resultado ?: null;
}

function atualizarFornecedor(PDO $conexao, int $id, string $nome): void {

    $sql = "UPDATE fornecedores SET nome = :nome WHERE id = :id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':nome', $nome, PDO::PARAM_STR);
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

}

?>