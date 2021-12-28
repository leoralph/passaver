<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('passaver.auth.index');
    }

    public function autenticar(Request $request)
    {
        $credenciais = $request->validate([
            'password' => 'required',
            'email' => 'required'
        ]);

        if(Auth::attempt($credenciais)){
            return redirect()->route('home');
        }

        return back()->withErrors('Erro ao efetuar login');
    }

    public function naoVerificado()
    {
        return view('passaver.auth.nao-verificado');
    }

    public function verificarEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('home');
    }

    public function enviarVerificacao(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
