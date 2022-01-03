<?php

namespace App\Http\Controllers\Passaver;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('passaver.admin.index');
    }

    public function salvarArquivo(Request $request)
    {
        $arquivo = $request->file('arquivo');
        $hashName = pathinfo($arquivo->hashName())['filename'];

        Arquivo::criar($arquivo, $hashName);
        print_r(Auth::user()->diretorioPrivado()->putFileAs('/', $arquivo, $hashName));
    }
}
