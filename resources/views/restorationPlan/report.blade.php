@extends('adminlte::page')
@section('content_header')
    <h2>Reporte de los planes de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

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
                                <td>{{ $r["plan"]->annual_budget }}</td>
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
                    <div class="d-flex my-1">
                        <div class="d-flex flex-column mt-4 ml-auto mr-2">
                            <a href="{{ route('restorationPlan.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                <span>Atrás</span>
                            </a>
                        </div>
                        <div class="d-flex flex-column mt-4 mr-2">
                            <a href="{{ route('restorationPlan.downloadReport') }}" class="btn btn-xs btn-primary text-white py-2 px-3 shadow">
                                <span>Exportar como PDF</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const message = document.querySelectorAll('.message')
        if(message[0].innerText !== null){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: message[0].innerText,
                showConfirmButton: false,
                timer: 2000
            })
        }
    </script>

@endsection
