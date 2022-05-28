<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validacao = Validator::make($request->except('remember'), [
            'email' => 'required|email',
            'senha' => 'required'
        ]);

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), 403);
        }

        $credenciais = $validacao->validated();

        $auth = auth()->attempt(['email' => $credenciais['email'], 'password' => $credenciais['senha']], $request->remember ?? false);

        if ($auth) {
            $request->session()->regenerate();

            return response()->json([
                'usuario' => auth()->user()
            ]);
        }

        return response()->json(['msg' => 'Credenciais Inválidas'], 403);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
    }
}
