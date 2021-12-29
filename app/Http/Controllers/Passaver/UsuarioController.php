<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UsuarioController extends Controller
{
    public function perfil()
    {
        return view('passaver.usuario.perfil');
    }

    public function cadastrarUsuario()
    {
        return view('passaver.usuario.cadastrar');
    }

    public function salvarCadastro(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|min:3',
            'email' => 'required|email',
            'senha' => ['required', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()]
        ]);
        
        Usuario::criar($dados);
    }
}
