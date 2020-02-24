<?php
namespace App\API;

class ApiError {
    
    //Validação de erros da aplicação
    public static function errorMessage($message, $code)
    {
        return[
            'msg'   => $message,
            'code'  => $code
        ];
    }
}
