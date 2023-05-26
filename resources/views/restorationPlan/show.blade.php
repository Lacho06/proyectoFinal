@extends('adminlte::page')
@section('content_header')
    <h2>Detalles del plan de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @if (Session::has('message'))
        <div class="d-none message">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 py-3 px-5">
                <div class="card-body">
                    <div class="d-flex mt-3 mb-auto">
                        <img class="rounded-circle border border-dark" width="80" height="80" src="{{ asset('src/icons/plan.png') }}" alt="">
                        <div class="d-flex w-100 justify-content-around ml-2">
                            <div class="d-flex flex-column my-auto">
                                <div class="d-flex my-1 w-100">
                                    <h3 class="my-auto mx-3">Año:</h3>
                                    <div class="border d-flex border-dark flex-wrap my-2 ml-auto" style="min-width: 250px !important; aspect-ratio: 5/1 !important; border-radius: 5px !important;">
                                        <p class="m-auto">{{ $plan->year }}</p>
                                    </div>
                                </div>
                                <div class="d-flex my-1 w-100">
                                    <h3 class="my-auto mx-3">Presupuesto:</h3>
                                    <div class="border d-flex border-dark flex-wrap my-2 ml-auto" style="min-width: 250px !important; aspect-ratio: 5/1 !important; border-radius: 5px !important;">
                                        <p class="m-auto">{{ $plan->annual_budget }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $heads = [
                            'Nombre',
                            'Autor',
                            'Presupuesto',
                            'Fecha inicial',
                            'Fecha final',
                            'Estado'
                        ];

                    @endphp
                    <div class="card col-12 mt-5">
                        <div class="card-header d-flex py-2">
                            <h4 class="mx-auto">Obras vinculadas</h4>
                        </div>
                        <div class="card-body pt-3">
                            <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify bordered>
                                {{-- @foreach($culturalWorks as $culturalWork)
                                    <tr>
                                        <td>{{ $culturalWork->id }}</td>
                                        <td>{{ $culturalWork->title }}</td>
                                        @if ($culturalWork->author)
                                            <td>{{ $culturalWork->author->name }}</td>
                                        @else
                                            <td>No tiene</td>
                                        @endif
                                    </tr>
                                @endforeach --}}
                            </x-adminlte-datatable>
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
