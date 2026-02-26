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
            return trim(filter_var($entrada, FILTER_SANITIZE_EMAIL));

        case 'texto':
            default:
                return trim(filter_var($entrada, FILTER_SANITIZE_FULL_SPECIAL_CHARS));

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

function formatarData(?string $data):string 
{
    return $data ? date("d/m/Y", strtotime($data)) : "-";
}

function formatarPreco(float $preco): string
{
    return "R$ " . number_format($preco, 2, ",", ".");
}