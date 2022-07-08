<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Senha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'contas' => auth()->user()->contas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = Validator::make($request->all(), [
            'apelido' => 'required',
            'credencial' => 'required',
            'senha' => 'required'
        ]);

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), 422);
        }

        Conta::criar($validacao->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conta = auth()->user()->contas->find($id);

        if (empty($conta)) {
            return response()->json([], 204);
        }

        $senha = $conta->getSenha();

        return response()->json([
            'id' => $conta->id,
            'apelido' => $conta->apelido,
            'credencial' => $conta->credencial,
            'senha' => $senha->senha
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validacao = Validator::make($request->all(), [
            'apelido' => 'required',
            'credencial' => 'required',
            'senha' => 'required'
        ]);

        if ($validacao->fails()) {
            return response()->json($validacao->errors(), 422);
        }

        Conta::atualizar($id, $validacao->validated());

        return response([], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $conta = auth()->user()->contas->find($id);

        Senha::destroy($conta->getSenha()->id);

        $conta->delete();
    }

    /**
     * Importa contas à partir da planilha csv do google
     * 
     * @param Request $request 
     * @return \Illuminate\Http\Response 
     */
    public function importar(Request $request)
    {
        $planilha = fopen($request->file('files')[0], 'r');
        while (($linha = fgetcsv($planilha)) !== false) {
            if ($linha[0] == 'name' && $linha[1] == 'url') continue;
            if ($linha[0] && $linha[2] && $linha[3]) {
                Conta::criar([
                    'apelido' => $linha[0],
                    'credencial' => $linha[2],
                    'senha' => $linha[3]
                ]);
            }
        }
    }
}
