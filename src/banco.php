<?php 
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "flybyday_estoque.sql";


    //Script de conexão

    try {

        $sql = new PDO("mysql:host=$servidor; dbname=$banco; charset=utf8", $usuario, $senha);
        
        
        $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo"Conexão feita com sucesso!";
    } catch (Throwable $erro) {

        die("Falha na conexão:  " . $erro->getMessage());
    }
?>