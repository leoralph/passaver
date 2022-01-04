@extends('passaver.templates.base')
@section('title', 'Passaver - Não verificado')
@section('content')
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <h4>Email ainda não verificado</h4>
            </div>
        </div>
        <div class="row mt-2">
            <p class="fs-5">Olá, seu email ainda não foi verificado, para reenviar a mensagem de verificação <a href="{{route('verification.send')}}">Clique aqui</a>.</p>
        </div>
    </div>
@endsection