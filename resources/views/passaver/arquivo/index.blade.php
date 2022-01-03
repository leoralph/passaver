@extends('passaver.templates.base')
@section('title', 'Passaver - Listar Arquivos')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h4>Arquivos</h4>
            </div>
            <div class="col text-end">
                <button class="btn btn-secondary passaver-modal" href="{{route('arquivo.modal')}}"><i class="bi-plus-lg"></i> Novo</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <th scope="col">Nome</th>
                <th>Data de Criação</th>
                <th>Tamanho</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                @foreach (Auth::user()->arquivos as $arquivo)
                    <tr>
                        <td>
                            <a href="{{route('arquivo.download', ['referencia' => $arquivo->referencia])}}">{{$arquivo->nomeCompleto()}}</a>
                        </td>
                        <td>
                            {{$arquivo->created_at}}
                        </td>
                        <td>
                            {{$arquivo->tamanhoFormatado()}}
                        </td>
                        <td>
                            <a href="{{route('arquivo.excluir', ['id' => Crypt::encryptString($arquivo->id)])}}" class="btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection