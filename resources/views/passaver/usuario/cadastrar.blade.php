@extends('passaver.templates.base')
@section('title', 'Passaver - Cadastro')
@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <form action="{{route('passaver.usuario.salvar-cadastro')}}" method="POST" class="col col-md-6 col-lg-4 p-3 bg-secondary rounded">
                @csrf
                <div class="row justify-content-center">
                    <div class="col">
                        <label for="nome" class="form-label text-light">Nome:</label>
                        <input type="nome" name="nome" id="nome" class="form-control" value="{{old('nome') ?? ''}}" placeholder="Nome">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col">
                        <label for="email" class="form-label text-light">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{old('email') ?? ''}}" placeholder="Email">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col">
                        <label for="senha" class="form-label text-light">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control" value="{{old('senha') ?? ''}}" placeholder="Senha">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col">
                        <label for="senha_confirmation" class="form-label text-light">Confirmar Senha:</label>
                        <input type="password" name="senha_confirmation" id="senha_confirmation" value="{{old('senha_confirmation') ?? ''}}" class="form-control" placeholder="Confirmar Senha">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <a href="{{route('passaver.login')}}">Fazer login</a>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col d-grid">
                        <button type="submit" class="btn btn-primary">CADASTRAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection