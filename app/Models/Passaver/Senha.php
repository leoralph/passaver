<?php

namespace App\Models\Passaver;

use App\Ferramentas\Passaver\UserCrypt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Senha extends Model
{
    use HasFactory;

    protected $connection = 'passaver';

    protected $fillable = [
        'usuario_id',
        'senha'
    ];

    public static function criar(array $data)
    {
        return self::create([
            'usuario_id' => Auth::user()->id,
            'senha' => UserCrypt::encryptString($data['conta_id'] . '{passaver}' . $data['senha'])
        ]);
    }
}
