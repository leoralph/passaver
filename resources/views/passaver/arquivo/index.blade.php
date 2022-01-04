@extends('passaver.templates.base')
@section('title', 'Passaver - Listar Arquivos')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h4>Arquivos</h4>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6 col-md-2">
                <input class="form-control form-control-sm" type="text" id="pesquisar" placeholder="Pesquisar">
            </div>
            <div class="col text-end">
                <button class="btn btn-secondary passaver-modal" href="{{route('passaver.arquivo.modal')}}"><i class="bi-plus-lg"></i> Publicar</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>#</th>
                <th scope="col">Nome</th>
                <th>Data de Criação</th>
                <th>Tamanho</th>
                <th>Excluir</th>
            </thead>
            <tbody>
                @foreach (Auth::user()->arquivos as $arquivo)
                    <tr>
                        <td>
                            {{$loop->iteration}}
                        </td>
                        <td>
                            <a href="{{route('passaver.arquivo.download', ['referencia' => $arquivo->referencia])}}">{{$arquivo->nomeCompleto()}}</a>
                        </td>
                        <td>
                            {{$arquivo->created_at->format('d/m/Y')}}
                        </td>
                        <td>
                            {{$arquivo->tamanhoFormatado()}}
                        </td>
                        <td>
                            <a id="{{Crypt::encryptString($arquivo->id)}}" case="{{Crypt::encryptString(2)}}" class="excluir-item btn btn-danger btn-sm"><i class="bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
@endsection