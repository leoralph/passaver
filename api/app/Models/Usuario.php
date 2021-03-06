<?php

namespace App\Models;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Encryption\Encrypter;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
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

    public function diretorioPrivado() : FilesystemAdapter
    {
        $diretorio = storage_path('app/usuarios/' . $this->email . '/');

        if (!is_writable($diretorio)) {
            mkdir($diretorio, 0777, true);
        }

        return Storage::createLocalDriver(['root' => $diretorio]);
    }

    public function crypt(string|int $value)
    {
        return (new Encrypter(base64_decode(Chave::buscaChaveUsuario($this)), 'AES-256-CBC'))->encryptString($value);
    }

    public function decrypt(string $value)
    {
        return (new Encrypter(base64_decode(Chave::buscaChaveUsuario($this)), 'AES-256-CBC'))->decryptString($value);
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
}
