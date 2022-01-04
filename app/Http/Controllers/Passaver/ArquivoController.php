<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ArquivoController extends Controller
{
    public function index()
    {
        return view('passaver.arquivo.index');
    }

    public function modal()
    {
        return view('passaver.arquivo.modal');
    }

    public function download(Request $request, $referencia)
    {
        $arquivo = Arquivo::where('usuario_id', Auth::user()->id)->where('referencia', $referencia)->first();
        return Auth::user()->diretorioPrivado()->download($arquivo->caminhoCompleto(), $arquivo->nomeCompleto());
    }

    public function salvarArquivo(Request $request)
    {
        $arrayIndevidos = [];

        foreach ($request->file('arquivos') as $file) {
            if ($file->getSize() > 20971520) {
                $arrayIndevidos[] = $file->getClientOriginalName() . 'tamanho limite de 20Mb excedido.';
                continue;
            }

            $hashName = pathinfo($file->hashName())['filename'];

            Arquivo::criar($file, $hashName);
            Auth::user()->diretorioPrivado()->putFileAs('/', $file, $hashName);
        }

        return redirect()->route('passaver.arquivo.listar')->withErrors($arrayIndevidos);
    }

    public function excluirArquivo($id)
    {
        $arquivo = Arquivo::find(Crypt::decryptString($id));
        Auth::user()->diretorioPrivado()->delete($arquivo->caminhoCompleto());
        $arquivo->delete();

        return redirect()->route('passaver.arquivo.listar');
    }
}
