<?php

namespace App\Http\Controllers\Passaver;

use App\Ferramentas\UserCrypt;
use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ExclusaoController extends Controller
{
    public function modal(Request $request)
    {   
        $dados = $request->validate([
            'target' => 'required',
            'case' => 'required'
        ]);

        return view('passaver.templates.modal-excluir', $dados);
    }

    public function confirmarExclusao(Request $request)
    {
        $request->validate([
            'case' => 'required|min:60',
            'target' => 'required|min:60'
        ]);
        
        $case = Crypt::decryptString($request->input('case'));
        $target = Crypt::decryptString($request->input('target'));
        
        switch ($case) {
            case 1:
                //Exclusão de conta
                $conta = Conta::find($target);
                foreach (Auth::user()->senhas as $senha) {
                    $arraySenha = explode('{passaver}', UserCrypt::decryptString($senha->senha));
                    if ($arraySenha[0] == $conta->id) {
                        $conta->delete();
                        $senha->delete();
                        break;
                    }
                }

                break;

            case 2:
                //Exclusão de arquivo
                $arquivo = Arquivo::find($target);
                Auth::user()->diretorioPrivado()->delete($arquivo->caminhoCompleto());
                $arquivo->delete();

                break;
        }

        return back();
    }
}
