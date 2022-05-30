<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class Arquivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'referencia',
        'nome',
        'extensao',
        'diretorio',
        'tamanho'
    ];

    protected $hidden = [
        'updated_at',
        'usuario_id',
        'referencia',
        'extensao'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y'
    ];

    public static function criar(UploadedFile $arquivo, $diretorio = '/'){
        $hashComExtensao = explode('.', $arquivo->hashName());
        $nome = pathinfo($arquivo->getClientOriginalName(), PATHINFO_FILENAME);

        auth()->user()->diretorioPrivado()->putFileAs($diretorio, $arquivo, $hashComExtensao[0]);

        self::create([
            'usuario_id' => Auth::user()->id,
            'referencia' => $hashComExtensao[0],
            'nome' => $nome,
            'extensao' => $hashComExtensao[1],
            'diretorio' => $diretorio,
            'tamanho' => $arquivo->getSize()
        ]);
    }

    public function nomeCompleto()
    {
        return $this->nome . '.' . $this->extensao;
    }

    public function caminhoCompleto()
    {
        return $this->diretorio . $this->referencia;
    }

    public function tamanhoFormatado()
    {
        if($this->tamanho < 1024)
        {
            return $this->tamanho . 'B';
        }
        else if ($this->tamanho < 1048576)
        {
            return round($this->tamanho/1000, 1) . 'Kb';
        }
        else if($this->tamanho < 1073741824)
        {
            return round($this->tamanho/1000000, 1) . 'Mb';
        }
    }

    protected function tamanho() : Attribute
    {
        return Attribute::make
        (
            get: function ($value) {
                if($value < 1024)
                {
                    return $value . 'B';
                }
                else if ($value < 1048576)
                {
                    return round($value/1000, 2) . 'Kb';
                }
                else if($value < 1073741824)
                {
                    return round($value/1000000, 2) . 'Mb';
                }
            }
        );
    }

    protected function nome() : Attribute
    {
        return Attribute::make
        (
            get: fn ($value, $attr) => "$value.{$attr['extensao']}"
        );
    }
}
