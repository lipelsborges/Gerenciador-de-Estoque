<?php

 function buscarLoja(PDO $conexao): array{

    $sql = 'SELECT * FROM lojas';

    $query = $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

 }

 function inserirLoja(PDO $conexao, $nome):void {

   $sql = 'INSERT INTO lojas (nome) VALUES (:nome)';

   $query = $conexao->prepare($sql);
   $query->bindValue(':nome', $nome, PDO::PARAM_STR);
   $query->execute();

 }

 function buscarLojaPorId(PDO $conexao, $id): ?array {

   $sql = 'SELECT * FROM lojas WHERE id = :id';

   $query = $conexao->prepare($sql);
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   
   $query->execute();
   $resultado = $query->fetch(PDO::FETCH_ASSOC);
   return $resultado ?: null;


 }

 function excluirLoja(PDO $conexao, $id): void {

   $sql = 'DELETE FROM lojas WHERE id = :id';

   $query = $conexao->prepare($sql);
   $query->bindValue(':id', $id, PDO::PARAM_INT);
   $query->execute();

 }

 function atualizarLoja(PDO $conexao, int $id, string $nome): void{

  $sql = "UPDATE lojas SET nome = :nome WHERE id= :id";
  $query = $conexao->prepare($sql);
  $query->bindValue(':id', $id, PDO::PARAM_INT);
  $query->bindValue(':nome', $nome, PDO::PARAM_STR);
  $query->execute();

 }