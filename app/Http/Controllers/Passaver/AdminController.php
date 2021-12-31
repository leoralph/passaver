<?php

namespace App\Http\Controllers\Passaver;

use App\Ferramentas\UserCrypt;
use App\Http\Controllers\Controller;
use App\Models\Chave;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function index()
    {
        return view('passaver.admin.index');
    }

    public function recriptografarSenhas(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required'
        ]);

        $usuario = Usuario::find($request['usuario_id']);

        $senhas = $usuario->senhas;

        foreach($senhas as $senha){
            
            try {
                $senha->senha = UserCrypt::encryptString(Crypt::decryptString($senha->senha));
                $senha->save();
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                continue;
            }
        }

    }

}
