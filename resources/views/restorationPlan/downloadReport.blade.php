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
    <h2>Reporte de los planes de restauración</h2>
    <div class="mb-3"></div>

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 py-3 px-5">
                <div class="card-body">
                    @php
                        $heads = [
                            'ID',
                            'Año',
                            'Presupuesto',
                            'Gasto total de las obras',
                            'Presupuesto restante'
                        ];
                    @endphp
                    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify bordered>
                        @foreach($report as $r)
                            <tr>
                                <td>{{ $r["plan"]->id }}</td>
                                <td>{{ $r["plan"]->year }}</td>
                                <td>{{ $r["plan"]->annual_budget }} CUP</td>
                                @if ($r["sum_budget"] > 0)
                                    <td class="text-success">{{ $r["sum_budget"] }} CUP</td>
                                @else
                                    <td class="text-danger">{{ $r["sum_budget"] }} CUP</td>
                                @endif
                                @if ($r["budget_remaining"] > 0)
                                    <td class="text-success">{{ $r["budget_remaining"] }} CUP</td>
                                @else
                                    <td class="text-danger">{{ $r["budget_remaining"] }} CUP</td>
                                @endif
                            </tr>
                        @endforeach
                    </x-adminlte-datatable>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
