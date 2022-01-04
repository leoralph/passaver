<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SenhaController extends Controller
{
    public function gerar()
    {
        $letras = 'abcdefghijklmnopqrstuvwxyz';
        $maiusculas = strtoupper($letras);
        $especiais = '!@#$%&*()^?/';

        $senha = '';

        for($i = 0; $i < 12; $i++){
            switch (random_int(1,5)) {
                case 1:
                    $senha .= $letras[random_int(0, strlen($letras)-1)];
                    break;
                case 2:
                    $senha .= $letras[random_int(0, strlen($letras)-1)];
                    break;
                case 3:
                    $senha .= $maiusculas[random_int(0, strlen($maiusculas)-1)];
                    break;
                case 4:
                    $senha .= $maiusculas[random_int(0, strlen($maiusculas)-1)];
                    break;
                case 5:
                    $senha .= $especiais[random_int(0, strlen($especiais)-1)];
                    break;
            }
        }

        echo $senha;
        die;
    }
}
