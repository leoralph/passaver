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
                        <td><input class="input-senha" style="width: 90%" type="text" value="{{$conta->id}}" disabled></td>
                        <td><a href=""><i class="bi-eye-slash mostrar-senha" id="{{Crypt::encryptString($conta->id)}}"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('javascript')
    <script src="{{asset('asset/js/home.js')}}"></script>
@endsection