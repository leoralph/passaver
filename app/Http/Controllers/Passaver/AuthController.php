<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class AuthController extends Controller
{
    public function index()
    {
        return view('passaver.auth.index');
    }

    public function autenticar(Request $request)
    {
        $credenciais = $request->validate([
            'senha' => 'required',
            'email' => 'required|email'
        ]);

        if (Auth::attempt(['email' => $credenciais['email'], 'password' => $credenciais['senha']], $request->input('remember'))) {
            return redirect()->route('passaver.home');
        }

        return back()->withErrors('Erro ao efetuar login usuário ou senha inválidos.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('passaver.login');
    }

    public function naoVerificado()
    {
        return view('passaver.auth.nao-verificado');
    }

    public function verificarEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('passaver.home');
    }

    public function enviarVerificacao(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('passaver.login');
    }
}
