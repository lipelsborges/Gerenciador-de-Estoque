<?php 

function dump (mixed $dados):void{
    
    echo"<prev>";
    var_dump($dados);
    echo "</prev>";

}



function sanitizar(mixed $entrada, string $tipo): mixed {

    switch($tipo){
        case 'inteiro':
            return (int)filter_var($entrada, FILTER_SANITIZE_NUMBER_INT);

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

function verificarSenha ( string $senhaForm, string $senhaBanco ): string {


    if(password_verify($senhaForm, $senhaBanco)){
        
        return $senhaBanco;

    }else {

        return codificarSenha($senhaForm);

    }


}