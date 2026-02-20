<?php

function buscarUsuario(PDO $conexao): array {

    $sql = "SELECT id,nome, email FROM usuarios ORDER BY id";

    $query = $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}

function inserirUsuario(PDO $conexao, $nome, $email, $senha): void{

    $sql = "INSERT INTO usuarios (nome, email, senha) 
            VALUES (:nome, :email, :senha)";

    $query = $conexao->prepare($sql);
    $query->bindValue(':nome', $nome, PDO::PARAM_STR);
    $query-> bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':senha', $senha, PDO::PARAM_STR);

    $query->execute();

}


//a interrogação no array indica array || NULL;
function buscarUsuarioPorId(PDO $conexao, int $id) : ?array {
            $sql = "SELECT * FROM usuarios WHERE id =:id ";

            $query = $conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            
            $query ->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            return $resultado ?: null;
}

function atualizarUsuario(PDO $conexao, int $id, string $nome, string $email, string $senha):void {

              $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id";

              $query = $conexao->prepare($sql);
              $query->bindValue(':nome', $nome, PDO::PARAM_STR);
              $query->bindValue(':email', $email, PDO::PARAM_STR);
              $query->bindValue(':senha', $senha, PDO::PARAM_STR);
              $query->bindValue(':id', $id, PDO::PARAM_INT);

              $query->execute();

}

function excluirUsuario(PDO $conexao, $id): void{

    $sql = "DELETE FROM usuarios WHERE id = :id";

    $query = $conexao->prepare($sql);
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();



}


function buscarPorEmail(PDO $conexao, $email): ?array{

    $sql = "SELECT * FROM usuarios WHERE email = :email";

    $query = $conexao->prepare($sql);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
    return $usuario ?: null;
}