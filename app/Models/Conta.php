<?php

namespace App\Models;

use App\Ferramentas\Passaver\UserCrypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'apelido',
        'credencial',
        'usuario_id'
    ];

    protected $hidden = [
        'created_ad'
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

    public function getSenha()
    {
        foreach (auth()->user()->senhas as $senha) {
            $arraySenha = explode('{passaver}', auth()->user()->decrypt($senha->senha));
            if ($arraySenha[0] == $this->id) {
                return (object)['id' => $senha->id, 'senha' => $arraySenha[1]];
            }
        }
        return (object)['id' => null, 'senha' => null];
    }
}
