<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patrimonio Cultural</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans';
        }

        @font-face{
            font-family: 'Open Sans'
            src: {{ asset('fonts/Open_Sans/OpenSans-Regular.ttf') }}
        }

        .bg-blue{
            background: #202A62;
        }

        .my-btn{
            padding: 10px 40px;
            color: white;
            background: #202A62;
            border: 1px solid transparent;
            transform: scale(1);
            border-radius: 0 20% 0 20% / 0 40% 0 40%;
        }
        .my-btn:hover{
            transform: scale(.9);
            transition: transform ease .4s;
        }
        a{
            text-decoration: none;
        }
        a:hover{
            color:white;
        }
    </style>
</head>
<body>
    {{-- navbar --}}
    <nav class="d-flex p-2 mb-3 justify-content-between bg-blue">
        <h2 class="my-auto text-white">Patrimonio Cultural</h2>
        <div class="d-flex justify-content-end">
            @auth
                <a href="{{ route('logout') }}" class="btn btn-danger mx-2 my-auto">Cerrar sesión</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="btn btn-success mx-2 my-auto">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-danger mx-2 my-auto">Registrarse</a>
            @endguest
        </div>
    </nav>
    {{-- Fin navbar --}}
    <div class="d-flex">
        <h2 class="mx-auto">Bienvenido al Patrimonio Cultural de la UCI</h2>
    </div>
    {{-- Cards --}}
    <div class="container mx-auto">
        <div class="row">
            @foreach ($culturalWorks as $culturalWork)
            {{-- TODO: la clase card hay q ponerla en otro div dentro de este --}}
                <div class="card col-12 col-md-3 my-3">
                    <div class="card-image">
                        <img src="{{ Storage::url($culturalWork->image) }}" alt="{{ $culturalWork->title }}">
                    </div>
                    <div class="card-body">
                        <h2><span>Titulo: </span>{{ $culturalWork->title }}</h2>
                        @if ($culturalWork->author)
                            <h4><span>Autor: </span> {{ $culturalWork->author->name }}</h4>
                        @else
                            <h4><span>Autor: </span> No tiene</h4>
                        @endif
                        <div class="d-flex">
                            <div class="stars">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                                <span>5</span>
                            </div>
                            <a href="#" class="my-btn">Ver más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Fin cards --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
