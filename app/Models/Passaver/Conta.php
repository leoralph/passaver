<?php

namespace App\Models\Passaver;

use App\Ferramentas\Passaver\UserCrypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conta extends Model
{
    use HasFactory;

    protected $connection = 'passaver';

    protected $fillable = [
        'apelido',
        'credencial',
        'usuario_id'
    ];

    public static function criar(array $data)
    {
        $conta = self::create([
            'apelido' => $data['apelido'],
            'credencial' => $data['credencial'],
            'usuario_id' => Auth::user()->id
        ]);

        Senha::criar([
            'conta_id' => $conta->id,
            'senha' => $data['senha']
        ]);
    }
}
