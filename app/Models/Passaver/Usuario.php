<?php

namespace App\Models\Passaver;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'passaver';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function criar(array $data)
    {
        $usuario = self::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'senha' => Hash::make($data['senha'])
        ]);

        Chave::criarChaveUsuario($usuario);

        event(new Registered($usuario));
    }

    public function diretorioPrivado()
    {
        $diretorio = storage_path('app/usuarios/' . $this->email . '/');

        if (!is_writable($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        return Storage::createLocalDriver(['root' => $diretorio]);
    }

    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function contas()
    {
        return $this->hasMany(Conta::class)->orderBy('apelido');
    }

    public function senhas()
    {
        return $this->hasMany(Senha::class);
    }

    public function arquivos()
    {
        return $this->hasMany(Arquivo::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
