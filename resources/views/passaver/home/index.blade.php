@extends('passaver.templates.base')
@section('title', 'Passaver - Home')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h4>Contas</h4>
            </div>
            <div class="col text-end">
                <button class="btn btn-secondary passaver-modal" href="{{route('conta.cadastrar')}}"><i class="bi-plus-lg"></i> Nova</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <th scope="col">#</th>
                <th width="100%" scope="col">Apelido</th>
                <th colspan="2" class="text-center" scope="col">Ações</th>
            </thead>
            <tbody>
                @foreach (Auth::user()->contas as $conta)
                    <tr id="{{$conta->id*2}}">
                        <td>{{$loop->iteration}}</td>
                        <td>{{$conta->apelido}}</td>
                        <td class="text-center">
                            <button href="{{route('conta.consultar', ['id' => Crypt::encryptString($conta->id)])}}" class="btn btn-secondary btn-sm passaver-modal"><i class="bi-search"></i></button>
                        </td>
                        <td class="text-center px-0">
                            <button href="{{route('conta.excluir', ['id' => Crypt::encryptString($conta->id)])}}" class="btn btn-primary btn-sm excluir-conta"><i class="bi-trash"></i></button>
                        </td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('javascript')
<script src="{{asset('asset/js/home.js')}}"></script>
@endsection