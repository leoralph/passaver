<?php

namespace App\Http\Controllers\Passaver;

use App\Ferramentas\UserCrypt;
use App\Http\Controllers\Controller;
use App\Models\Conta;
use App\Models\Senha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ContaController extends Controller
{
    public function modalCadastrar()
    {
        return view('passaver.conta.modal-cadastrar');
    }

    public function modalConsultar($id)
    {
        $conta = Conta::find(Crypt::decryptString($id));
        
        foreach (Auth::user()->senhas as $senha) {
            $arraySenha = explode('{passaver}', UserCrypt::decryptString($senha->senha));
            if($arraySenha[0] == $conta->id){
                return view('passaver.conta.modal-consultar', [
                    'conta' => $conta,
                    'senha_id' => $senha->id,
                    'senha' => $arraySenha[1]
                ]);
            }
        }
    }

    public function salvar(Request $request)
    {
        $dados = $request->validate([
            'apelido' => 'required',
            'credencial' => 'required',
            'senha' => 'required'
        ]);

        Conta::criar($dados);

        return redirect()->route('home');
    }

    public function excluirConta($id)
    {
        $conta = Conta::find(Crypt::decryptString($id));

        foreach (Auth::user()->senhas as $senha) {
            $arraySenha = explode('{passaver}', UserCrypt::decryptString($senha->senha));
            if($arraySenha[0] == $conta->id){
                $conta->delete();
                $senha->delete();
            }
        }

    }

    public function atualizar(Request $request)
    {
        $dados = $request->validate([
            'conta_id' => 'required',
            'senha_id' => 'required',
            'apelido' => 'required',
            'credencial' => 'required',
            'senha' => 'required'
        ]);

        $conta_id = Crypt::decryptString($dados['conta_id']);

        Conta::find($conta_id)->update(['apelido' => $dados['apelido'], 'credencial' => $dados['credencial']]);
        Senha::find(Crypt::decryptString($dados['senha_id']))->update(['senha' => UserCrypt::encryptString($conta_id . '{passaver}' . $dados['senha'])]);

        return redirect()->route('home');
    }
}
