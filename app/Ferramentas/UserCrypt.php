<?php
namespace App\Ferramentas;

use App\Models\Chave;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Auth;

class UserCrypt 
{

    public static function encryptString($value)
    {
        return (new Encrypter(base64_decode(Chave::buscaChaveUsuario(Auth::user())), 'AES-256-CBC'))->encryptString($value);
    }

    public static function decryptString($payload)
    {
        return (new Encrypter(base64_decode(Chave::buscaChaveUsuario(Auth::user())), 'AES-256-CBC'))->decryptString($payload);
    }
}