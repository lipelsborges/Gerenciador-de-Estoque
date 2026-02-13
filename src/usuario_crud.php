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