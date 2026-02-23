<?php 
    $servidor = "127.0.0.1";
    $usuario = "root";
    $senha = "";
    $banco = "sys";



    //Script de conexão

    try {

        $conexao = new PDO("mysql:host=$servidor; dbname=$banco; charset=utf8", $usuario, $senha);
        
        
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //echo"Conexão feita com sucesso!";
    } catch (Throwable $erro) {

        die("Falha na conexão:  " . $erro->getMessage());
    }
?>