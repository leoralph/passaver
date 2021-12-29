@extends('passaver.templates.base')
@section('title', 'Passaver - Home')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Olá, {{Auth::user()->nome}}</h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <th>Apelido</th>
                <th>Credencial</th>
                <th>Senha</th>
                <th></th>
            </thead>
            <tbody>
                @foreach (Auth::user()->contas as $conta)
                    <tr id="{{$conta->id*2}}">
                        <td>{{$conta->apelido}}</td>
                        <td>{{$conta->credencial}}</td>
                        <td><input class="input-senha" type="text" value="{{$conta->id}}" disabled></td>
                        <td>
                            <a class="mostrar-senha" href="{{route('conta.buscar-senha', ['id' => Crypt::encryptString($conta->id)])}}"><i class="bi-eye-slash"></i></a>
                            <a class="excluir-conta" href="{{route('conta.excluir', ['id' => Crypt::encryptString($conta->id)])}}"><i class="bi-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('javascript')
<script src="{{asset('asset/js/home.js')}}"></script>
@endsection