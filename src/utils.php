<?php 

function codificarSenha( string $senha): string {

    return password_hash($senha, PASSWORD_DEFAULT);
}