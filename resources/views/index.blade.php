<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patrimonio Cultural</title>
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
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
    </style>
</head>
<body>
    {{-- Nav Bar --}}
    <x-navbar title="Patrimonio Cultural" />
    <div class="d-flex">
        <h2 class="mx-auto">Bienvenido al Patrimonio Cultural de la UCI</h2>
    </div>
    {{-- Cards --}}
    <div class="d-md-flex mt-4 justify-content-around">
        @foreach ($culturalWorks as $culturalWork)
            <x-card class="col-12 col-md-4" title="{{ $culturalWork->title }}"  />
        @endforeach
    </div>

</body>
</html>
