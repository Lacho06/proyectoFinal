@extends('adminlte::page')
@section('content_header')
    <h2>Agregar obras al plan de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @if (Session::has('message'))
        <div class="d-none message">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-around">
                        <div class="col-12">
                            <div class="d-flex flex-column p-2">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h3 class="ml-3">Obras vinculadas</h3>
                                    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-success text-white ml-auto mr-2 p-2 shadow" title="Agregar obra">
                                        <i class="fa fa-arrow-circle-right fa-lg"></i>
                                        <span>Agregar obra</span>
                                    </button>
                                </div>
                                <br />
                                <div class="d-flex p-2">
                                    @php
                                        $heads = [
                                            'ID',
                                            'Obra',
                                            ['label' => 'Autor', 'width' => 40],
                                            ['label' => 'Acción', 'no-export' => true, 'width' => 5],
                                        ];
                                        $config["lengthMenu"] = [ 5, 10, 20, 50];
                                    @endphp

                                    <x-adminlte-datatable id="table1" :config="$config" :heads="$heads" striped hoverable beautify bordered>
                                        @foreach($plan->culturalWorks as $culturalWork)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $culturalWork->title }}</td>
                                                @if ($culturalWork->author)
                                                    <td>{{ $culturalWork->author->name }}</td>
                                                @else
                                                    <td>No tiene</td>
                                                @endif
                                                <td class="d-flex">
                                                    <form action="{{ route('restorationPlan.unassociateCulturalWork') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="culturalWork_id" value="{{ $culturalWork->id }}">
                                                        <input type="hidden" name="restorationPlan_id" value="{{ $plan->id }}">
                                                        <button type="submit" class="btn btn-xs btn-danger btn-delete text-white py-1 mx-1 shadow" title="Desvincular">
                                                            <i class="fa fa-lg fa-fw fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </x-adminlte-datatable>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex py-2">
                                        <!-- Modal -->
                                        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Agregar obra a plan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('restorationPlan.associateCulturalWork') }}" method="POST">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <x-adminlte-select2 name="culturalWork_id" required label="Obra a vincular" data-placeholder="Obra a vincular..." value="{{ old('culturalWork_id') }}" label-class="text-lightblue"
                                                                igroup-size="md">
                                                                <option default value="" disabled>Obra, autor</option>
                                                                @forelse ($culturalWorks as $cw)
                                                                    <option value="{{ $cw->id }}"><span>Obra: </span>{{ $cw->title }},<span>Autor: </span> {{ $cw->author->name }}</option>
                                                                @empty
                                                                    <option value="" disabled>No hay obras para mostrar</option>
                                                                @endforelse
                                                            </x-adminlte-select2>
                                                            <x-adminlte-input type="date" required min="{{ date('Y-m-d') }}" name="start_date" label="Fecha inicial" placeholder="Fecha inicial..." value="{{ old('end_date') }}" label-class="text-lightblue"></x-adminlte-input>
                                                            <x-adminlte-input type="date" required min="{{ date('Y-m-d') }}" name="end_date" label="Fecha final" placeholder="Fecha final..." value="{{ old('end_date') }}" label-class="text-lightblue"></x-adminlte-input>
                                                            <input type="hidden" name="restorationPlan_id" value="{{ $plan->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-success">Aceptar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <form action="{{ route('restorationPlan.generatePlan') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                                            <input type="submit" class="btn btn-xs btn-primary text-white py-2 px-3 shadow" value="Generar plan">
                                        </form>
                                    </div>
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <a href="{{ route('restorationPlan.show', $plan->id) }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                            <span>Finalizar</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
    {{-- <script>
        $("#table1").dataTable().Destroy();
        $(document).ready(function (){
            $('#table1').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "searching": false,
                "retrieve": true
            });
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function (){
            $('#table1').DataTable({
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de forma ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de forma descendente"
                    }
                }
            });
        });
    </script> --}}
@endsection
