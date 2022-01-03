<?php

namespace App\Models;

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

    public static function criar(UploadedFile $arquivo, $hashName, $diretorio = '/'){
        $nome = pathinfo($arquivo->getClientOriginalName())['filename'];
        $extensao = pathinfo($arquivo->getClientOriginalName())['extension'];
        
        return self::create([
            'usuario_id' => Auth::user()->id,
            'referencia' => $hashName,
            'nome' => $nome,
            'extensao' => $extensao,
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
}
