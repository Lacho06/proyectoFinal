@extends('adminlte::page')
@section('content_header')
    <h2>Reporte de las obras</h2>
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
                    <div class="d-flex my-1">
                        <div class="d-flex flex-column mt-4 ml-auto mr-2">
                            <a href="{{ route('culturalWork.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                <span>Atrás</span>
                            </a>
                        </div>
                        <div class="d-flex flex-column mt-4 mr-2">
                            <a href="{{ route('culturalWork.downloadReport') }}" class="btn btn-xs btn-primary text-white py-2 px-3 shadow">
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
                timer: 1500
            })
        }
    </script>

@endsection
