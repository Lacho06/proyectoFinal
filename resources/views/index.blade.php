<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patrimonio Cultural</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            padding: 5px;
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

        .my-card{
            min-width: 300px;
            max-width: 300px;
            min-height: 300px;
            max-height: 300px;
            overflow: hidden;
        }

        .my-title-container{
            width: 100%;
        }

        .my-title{
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            font-size: 1.5em;
        }

        .my-author{
            font-size: .8em;
        }

        .my-author span{
            font-weight: 600;
            font-size: .9em;
        }
        .my-card-hover{
            text-align: center;
            transform: scale(1);
            height: 360px;
            border: 1px solid gray;
        }
        .my-card-hover:hover{
            transform: scale(.96);
            border: 1px dashed hsla(220, 80%, 40%, .4);
            transition: transform 5s 4s border 2s;
        }

        .my-card-hover:hover .my-title{
            background: white;
        }

        .my-login{
            transform: scale(1);
            border: none;
        }

        .my-login:hover{
            transform: scale(.9);
        }

        .my-search-icon{
            padding: 5px;
            transform: scale(1.4);
        }

        .my-search-icon:hover{
            background: #202A62;
            color: white;
            border-radius: 50%;
            transform: scale(1.3);
            transition: transform 1s;
        }

        .my-search{
            border: none;
            outline: none;
        }

        .my-card-container{
            position: relative;
            overflow: hidden;
        }

        @keyframes ocultar{
            from{
                transform: rotate(270deg) scale(.9) translateX(0);
            }
            to{
                transform: rotate(270deg) scale(.9) translateX(100px);
            }
        }

        .my-distintion{
            position: absolute;
            top: 20px;
            right: -15px;
            z-index: 1000;
            box-shadow: 3px 5px 10px hsla(0, 20%, 20%, .2);
            padding: 3px;
            transform: rotate(270deg) scale(.9);
            background: #FCFFA7;
            border: 1px solid white;
            border-radius: 15% 0 0 15% / 55% 0 0 55%;
        }

        .my-card-hover:hover .my-distintion{
            animation-name: ocultar;
            animation-duration: 3s;
            animation-fill-mode: forwards;
        }
        h2 a{
            text-decoration: none;
        }
        h2 a:hover{
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
    {{-- navbar --}}
    <nav class="d-flex p-2 mb-3 justify-content-between bg-blue">
        <h2>
            <a href="{{ route('home') }}" class="my-auto text-white">Patrimonio Cultural</a>
        </h2>
        <div class="d-flex justify-content-end">
            @auth
                <form action="{{ route('logout') }}" class="d-flex my-auto" method="POST">
                    @csrf
                    <input type="submit" class="text-white my-login bg-blue mx-2 my-auto" value="Cerrar sesión" />
                </form>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="text-white my-login mx-2 my-auto">Iniciar sesión</a>
            @endguest
        </div>
    </nav>
    {{-- Fin navbar --}}
    <div class="d-flex">
        <h2 class="mx-auto">Bienvenido al Patrimonio Cultural de la UCI</h2>
    </div>

    {{-- Buscador --}}
    <div class="row">
        <div class="col-3 my-4 mx-auto">
            <div class="card">
                <div class="d-flex justify-content-between align-items-center py-2 px-4">
                    <form action="{{ route('home.search') }}" method="post" class="form-search">
                        @csrf
                        <i class="fa fa-search my-search-icon" onclick="handleClick()"></i>
                        <input type="search" name="search" class="my-search">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin buscador --}}
    {{-- Cards --}}
    <div class="container mx-auto">
        <div class="row">
            @foreach ($culturalWorks as $culturalWork)
                @if ($loop->first)
                    <div class="col-12 col-md-6 my-3">
                        <div class="card my-card-hover" title="{{ $culturalWork->title }}">
                            <div class="d-flex h-100">
                                @if ($culturalWork->image)
                                    <img src="{{ Storage::url($culturalWork->image) }}" class="card-image col-6" height="100%" alt="Imagen de {{ $culturalWork->title }}">
                                @endif
                                <div class="card-body col-6 d-flex flex-column my-card-container">
                                    <div class="my-distintion d-flex flex-column align-items-center">
                                        <span>Más Popular</span>
                                        <div class="d-flex mx-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="my-title-container">
                                        <h2 class="my-title">{{ $culturalWork->title }}</h2>
                                    </div>
                                    @if ($culturalWork->author)
                                        <h4 class="my-author"><span>Autor: </span> {{ $culturalWork->author->name }}</h4>
                                    @else
                                        <h4 class="my-author"><span>Autor: </span> No tiene</h4>
                                    @endif
                                    <p class="align-self-start mt-5">{{ $culturalWork->review }}</p>
                                    <div class="d-flex mx-auto mt-auto">
                                        <a href="{{ route('home.show', $culturalWork) }}" class="my-btn mx-3">Ver más</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-12 col-md-3 my-3">
                        <div class="card my-card-hover" title="{{ $culturalWork->title }}">
                            @if ($culturalWork->image)
                                <img src="{{ Storage::url($culturalWork->image) }}" class="card-image" height="55%" alt="Imagen de {{ $culturalWork->title }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="my-title-container">
                                    <h2 class="my-title">{{ $culturalWork->title }}</h2>
                                </div>
                                @if ($culturalWork->author)
                                    <h4 class="my-author"><span>Autor: </span> {{ $culturalWork->author->name }}</h4>
                                @else
                                    <h4 class="my-author"><span>Autor: </span> No tiene</h4>
                                @endif
                                <div class="d-flex justify-content-between mt-auto">
                                    <div class="d-flex">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                    <a href="{{ route('home.show', $culturalWork) }}" class="my-btn">Ver más</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    {{-- Fin cards --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const btn = document.querySelector('i.my-search-icon')
        const form = document.querySelector('.form-search')

        const handleClick = () => {
            form.submit()
        }
    </script>
</body>
</html>
