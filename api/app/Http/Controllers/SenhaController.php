<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SenhaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $letras = 'abcdefghijklmnopqrstuvwxyz';
        $maiusculas = strtoupper($letras);
        $numeros = '0123456789';
        $especiais = '!@#$%&*()^?/';

        $senha = '';

        for($i = 0; $i < 16; $i++){
            switch (random_int(1,4)) {
                case 1:
                    $senha .= $letras[random_int(0, strlen($letras)-1)];
                    break;
                case 2:
                    $senha .= $numeros[random_int(0, strlen($numeros)-1)];
                    break;
                case 3:
                    $senha .= $maiusculas[random_int(0, strlen($maiusculas)-1)];
                    break;
                case 4:
                    $senha .= $especiais[random_int(0, strlen($especiais)-1)];
                    break;
            }
        }
    
        return response()->json([
            'pwd' => $senha
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
