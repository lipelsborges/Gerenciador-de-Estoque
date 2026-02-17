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


function buscarUsuarioPorId(PDO $conexao, int $id) : ?array {
            $sql = "SELECT * FROM usuarios WHERE id =:id ";

            $query = $conexao->prepare($sql);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            
            $query ->execute();
            $resultado = $query->fetch(PDO::FETCH_ASSOC);
            return $resultado ?: null;
}

