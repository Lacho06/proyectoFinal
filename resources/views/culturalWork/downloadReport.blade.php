<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h2>Reporte de las obras</h2>
    <div class="mb-3"></div>

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 py-3 px-5">
                <div class="card-body">
                    @php
                        $heads = [
                            'ID',
                            'Título',
                            'Año de instauración',
                            'Permiso de restauración',
                            'Presupuesto',
                            'Estado'
                        ];
                    @endphp
                    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify bordered>
                        @foreach($report as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ $r->title }}</td>
                                <td>{{ $r->year_of_stablishment }}</td>
                                <td>{{ $r->restore_permission }}</td>
                                @if ($r->budget > 0)
                                    <td class="text-success">{{ $r->budget }} CUP</td>
                                @else
                                    <td class="text-danger">{{ $r->budget }} CUP</td>
                                @endif
                                <td>{{ $r->state_of_disrepair }}</td>
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
