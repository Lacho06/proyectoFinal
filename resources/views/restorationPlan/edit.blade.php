@extends('adminlte::page')
@section('content_header')
    <h2>Editar plan de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('restorationPlan.update', $plan) }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf @method('PUT')
                            <div class="d-flex flex-column col-12">
                                <div class="d-flex col-12 mx-auto justify-content-center mb-4">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="year" label="Año" placeholder="Año..." value="{{ old('year', $plan->year) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="annual_budget" label="Presupuesto anual" placeholder="Presupuesto anual..." value="{{ old('annual_budget', $plan->annual_budget) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-dollar-sign text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex col-12 mx-auto">
                                    @php
                                        $heads = [
                                            'ID',
                                            'Obra',
                                            ['label' => 'Autor', 'width' => 40],
                                            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
                                        ];

                                    @endphp
                                    <div class="card col-12">
                                        <div class="card-header d-flex py-2">
                                            <h3 class="ml-3">Obras vinculadas</h3>
                                            <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-success text-white ml-auto mr-2 p-2 shadow" title="Agregar obra">
                                                <i class="fa fa-arrow-circle-right fa-lg"></i>
                                                <span>Agregar obra</span>
                                            </button>
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
                                                    <div class="modal-body">
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <x-adminlte-select2 name="culturalWork_id" label="Nombre de la obra" data-placeholder="Nombre de la obra..." value="{{ old('culturalWork_id') }}" label-class="text-lightblue"
                                                                igroup-size="md">
                                                                <option default value="" disabled>Obra, autor</option>
                                                                @forelse ($culturalWorks as $culturalWork)
                                                                    <option value="{{ $culturalWork->id }}"><span>Obra: </span>{{ $culturalWork->title }},<span>Autor: </span> {{ $culturalWork->author->name }}</option>
                                                                @empty
                                                                    <option value="" disabled>No hay obras para mostrar</option>
                                                                @endforelse
                                                            </x-adminlte-select2>
                                                            <x-adminlte-input type="date" min="{{ date('Y-m-d') }}" name="end_date" label="Fecha inicial" placeholder="Fecha inicial..." value="{{ old('end_date') }}" label-class="text-lightblue"></x-adminlte-input>
                                                            <x-adminlte-input type="date" min="{{ date('Y-m-d') }}" name="end_date" label="Fecha final" placeholder="Fecha final..." value="{{ old('end_date') }}" label-class="text-lightblue"></x-adminlte-input>
                                                            <div class="d-flex">
                                                                <x-adminlte-input-switch name="restore_permission" data-on-text="Si" data-off-text="No"
                                                                data-on-color="teal" class="my-auto" />
                                                                <span class="mx-2">Participa el autor</span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify bordered>
                                                @forelse($plan->culturalWorks as $culturalWork)
                                                    <tr>
                                                        <td>{{ $culturalWork->id }}</td>
                                                        <td>{{ $culturalWork->title }}</td>
                                                        @if ($culturalWork->author)
                                                            <td>{{ $culturalWork->author->name }}</td>
                                                        @else
                                                            <td>No tiene</td>
                                                        @endif
                                                        <td class="d-flex">
                                                            <a href="">
                                                                <button class="btn btn-xs btn-warning text-white py-1 mx-1 shadow" title="Editar">
                                                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                                                </button>
                                                            </a>
                                                            <button class="btn btn-xs btn-danger btn-delete text-white py-1 mx-1 shadow" title="Eliminar">
                                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                                            </button>
                                                            <form action="" class="d-none form-delete" method="post">
                                                                @csrf @method("DELETE")
                                                                <input type="submit" value="Send" class="d-none">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td>No existen obras asociadas a este plan</td>
                                                    </tr>
                                                @endforelse
                                            </x-adminlte-datatable>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column mt-4 ml-auto mr-2">
                                        <a href="{{ route('restorationPlan.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                            <span>Atrás</span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <button type="submit" class="btn btn-xs btn-warning text-white py-2 px-3 shadow" title="Enviar">
                                            <i class="fa fa-arrow-circle-right fa-lg"></i>
                                            <span>Actualizar</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
