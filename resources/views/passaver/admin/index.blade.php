@extends('passaver.templates.base')
@section('title', 'Passaver - Painel de Admin')
@section('content')
    <div class="container">
        <form action="{{route('admin.recriptografar-senha')}}" method="POST">
            @csrf
            <div class="row mt-3">
                <h2>Recriptografar senhas do usuário id:</h2>
            </div>
            <div class="row">
                <div class="col">
                    <input type="number" name="usuario_id" class="form-control">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>
@endsection