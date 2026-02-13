<?php 

function sanitizar(mixed $entrada, string $tipo): mixed {

    switch($tipo){
        case 'email':
            return filter_var($entrada, FILTER_SANITIZE_EMAIL);

        case 'texto':
            default:
                return filter_var($entrada, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    }

}


function codificarSenha( string $senha): string {

    return password_hash($senha, PASSWORD_DEFAULT);
}