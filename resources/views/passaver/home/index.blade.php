@extends('passaver.templates.base')
@section('title', 'Passaver - Home')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h4>Contas</h4>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-6 col-md-2">
                <input class="form-control form-control-sm" type="text" id="pesquisar" placeholder="Pesquisar">
            </div>
            <div class="col text-end">
                <button class="mb-1 btn btn-secondary passaver-modal" href="{{route('passaver.conta.modal')}}"><i class="bi-plus-lg"></i> Nova</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th width="100%" scope="col">Apelido</th>
                <th colspan="2" class="text-center" scope="col">Ações</th>
            </thead>
            <tbody id="tbody">
                @foreach (Auth::user()->contas as $conta)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$conta->apelido}}</td>
                        <td class="text-center">
                            <button href="{{route('passaver.conta.modal', ['id' => Crypt::encryptString($conta->id)])}}" class="btn btn-secondary btn-sm passaver-modal"><i class="bi-search"></i></button>
                        </td>
                        <td class="text-center px-0">
                            <button id="{{Crypt::encryptString($conta->id)}}" case="{{Crypt::encryptString(1)}}" class="btn excluir-item btn-primary btn-sm"><i class="bi-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection