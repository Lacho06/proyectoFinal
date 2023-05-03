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

    </style>
</head>
<body>
    {{-- navbar --}}
    <nav class="d-flex p-2 mb-3 justify-content-between bg-blue">
        <h2 class="my-auto text-white">Patrimonio Cultural</h2>
        <div class="d-flex justify-content-end">
            @auth
                {{-- Arreglar el cerrar sesion  --}}
                <a href="{{ route('logout') }}" class="btn btn-danger mx-2 my-auto">Cerrar sesión</a>
            @endauth
            @guest
                <a href="{{ route('login') }}" class="text-white my-login mx-2 my-auto">Iniciar sesión</a>
            @endguest
        </div>
    </nav>
    {{-- Fin navbar --}}

    <div class="row">
        <div class="col-12">
            <img src="{{ Storage::url($culturalWork->image) }}" alt="{{ $culturalWork->title }}">
        </div>
    </div>


    <div class="container mx-auto d-flex flex-column">
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="d-flex justify-content-between">
                    <h2>Título: <span>{{ $culturalWork->title }}</span></h2>
                    <h2>Año: <span>{{ $culturalWork->year_of_stablishment }}</span></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                <div class="d-flex flex-column justify-content-between">
                    <h2>Ubicación: <span>{{ $culturalWork->location }}</span></h2>
                    <h2>Autor:
                        @if ($culturalWork->author)
                            <span>{{ $culturalWork->author->name }}</span>
                        @else
                            <span>No tiene</span>
                        @endif
                    </h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mx-auto">
                <div class="d-flex justify-content-between">
                    <h2>Reseña:</h2>
                    <p>{{ $culturalWork->review }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 mx-auto">
                <div class="d-flex justify-content-between">
                    <h2>Popularidad:</h2>
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p>90 usuarios han puntuado</p>
                    </div>
                    <div class="d-flex flex-column">
                        <div class="d-flex">
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                        </div>
                        <p>mi puntuación actual</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
