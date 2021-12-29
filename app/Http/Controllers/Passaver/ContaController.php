<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ContaController extends Controller
{
    public function buscarSenha($id)
    {
        $conta_id = Crypt::decryptString($id);
        foreach (Auth::user()->senhas as $senha) {
            $arraySenha = explode('{passaver}', Crypt::decryptString($senha->senha));
            if($arraySenha[0] == $conta_id){
                echo $arraySenha[1];
                die;
            }
        }
    }
}
