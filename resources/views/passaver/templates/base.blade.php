<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('asset/css/main.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @yield('css')
    <title>@yield('title', 'Passaver')</title>
</head>
<body>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModal" aria-hidden="true"></div>
    <nav class="navbar fs-5 p-2 navbar-dark bg-primary navbar-expand-md">
        <div class="container-fluid">
            <a href="{{route('home')}}" class="navbar-brand fs-4">Passaver</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="myNav">
                <ul class="navbar-nav ms-3 me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('arquivo.listar')}}"><i class="bi-file-post"></i> Arquivos</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @if (Request::path() != 'login' && Request::path() != 'cadastrar')
                        <li class="nav-item">
                            <a href="{{route('usuario.perfil')}}" class="nav-link {{Request::path() == 'perfil' ? 'active' : ''}}"><i class="bi-person"></i> {{Auth::user()->nome}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link"><i class="bi-power"></i> Sair</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @if ($errors->any())
    <div class="alert alert-danger py-1 text-center">
        @foreach ($errors->all() as $error)
            <p class="mt-2">{{$error}}</p>
        @endforeach
    </div>
    @endif
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('asset/js/main.js')}}"></script>
    @yield('javascript')
</body>
</html>