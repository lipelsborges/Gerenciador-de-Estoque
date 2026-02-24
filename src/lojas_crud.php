<?php

 function buscarLoja(PDO $conexao): array{

    $sql = 'SELECT * FROM lojas';

    $query = $conexao->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

 }