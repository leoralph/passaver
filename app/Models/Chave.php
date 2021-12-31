<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Chave extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_chave',
        'chave'
    ];

    public static function criarChaveUsuario(Usuario $usuario)
    {
        $chave = base64_encode(Crypt::generateKey('AES-256-CBC'));
        
        return self::create([
            'tipo_chave' => 'usuario',
            'chave' => substr_replace(Crypt::encryptString($chave), $usuario->id, 4, 0)
        ]);
    }

    public static function buscaChaveUsuario(Usuario $usuario)
    {
        $chave = self::where('chave', 'like', '____' . $usuario->id . '%')->first();

        if(!empty($chave)){
            return Crypt::decryptString(substr_replace($chave->chave, '', 4, 1));
        }

        return Crypt::decryptString(substr_replace(self::criarChaveUsuario($usuario)->chave, '', 4, 1));        
    }
}
