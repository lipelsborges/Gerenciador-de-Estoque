<?php

function buscarUsuario(PDO $conexao): array {

    $sql = "SELECT id,nome, email FROM usuarios ORDER BY id";
    $query = $conexao->prepare($sql);

    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);

}
