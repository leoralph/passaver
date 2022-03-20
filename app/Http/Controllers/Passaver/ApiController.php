<?php

namespace App\Http\Controllers\Passaver;

use App\Ferramentas\Passaver\UserCrypt;
use App\Http\Controllers\Controller;
use App\Models\Passaver\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validacao->fails()) {
            return response()->json(['erro' => $validacao->errors()]);
        }

        $try = auth('api')->attempt($validacao->validated());

        if ($try) {
            return response()->json(['token' => $try]);
        }

        return response()->json(['erro' => 'Usuário ou senha inválidos'])->setStatusCode(403);
    }

    public function listarContas()
    {
        $contas = Auth::user()->contas->transform(function ($item) {
            return $item->only(['id', 'apelido']);
        });

        return response()->json($contas);
    }

    public function conta($id)
    {
        $conta = Conta::where('id', $id)->where('usuario_id', Auth::user()->id)->first();

        if (empty($conta)) {
            return response()->json(['erro' => 'Conta não encontrada']);
        }

        foreach (Auth::user()->senhas as $senha) {
            $arraySenha = explode('{passaver}', UserCrypt::decryptString($senha->senha));
            if ($arraySenha[0] == $conta->id) {
                return response()->json([
                    'id' => $conta->id,
                    'apelido' => $conta->apelido,
                    'credencial' => $conta->credencial,
                    'senha' => $arraySenha[1]
                ]);
            }
        }
    }
}
