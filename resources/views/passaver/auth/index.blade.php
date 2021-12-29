@extends('passaver.templates.base')
@section('title', 'Passaver - Login')
@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <form action="{{route('autenticar')}}" method="POST" class="col col-md-6 col-lg-4 p-3 bg-secondary rounded">
                @csrf
                <div class="row justify-content-center">
                    <div class="col">
                        <label for="email" class="form-label text-light">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                </div>
                <div class="row justify-content-center mt-2">
                    <div class="col">
                        <label for="senha" class="form-label text-light">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <a href="{{route('usuario.cadastrar')}}">Cadastre-se</a>
                    </div>
                    <div class="col-auto">
                        <input type="hidden" name="remember" value="0">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">
                        <label for="remember" class="form-check-label text-light">Lembrar de mim</label>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col d-grid">
                        <button type="submit" class="btn btn-primary">ENTRAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection