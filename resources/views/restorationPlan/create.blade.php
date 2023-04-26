@extends('adminlte::page')
@section('content_header')
    <h2>Crear plan de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-10 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body p-5">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('restorationPlan.store') }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf
                            <div class="d-flex flex-column col-12">
                                <div class="d-flex col-12 mx-auto justify-content-center mb-4">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="year" label="Año" placeholder="Año..." value="{{ old('year') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="annual_budget" label="Presupuesto anual" placeholder="Presupuesto anual..." value="{{ old('annual_budget') }}" label-class="text-lightblue">
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
                                            <button type="submit" class="btn btn-xs btn-success text-white ml-auto mr-2 p-2 shadow" title="Enviar">
                                                <i class="fa fa-arrow-circle-right fa-lg"></i>
                                                <span>Agregar obra</span>
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify bordered>
                                                @foreach($culturalWorks as $culturalWork)
                                                    <tr>
                                                        <td>{{ $culturalWork->id }}</td>
                                                        <td>{{ $culturalWork->title }}</td>
                                                        @if ($culturalWork->author)
                                                            <td>{{ $culturalWork->author->name }}</td>
                                                        @else
                                                            <td>No tiene</td>
                                                        @endif
                                                        <td class="d-flex">
                                                            {{-- TODO: falta agregar la funcionalidad de esos botones --}}
                                                            <a href="">
                                                                <button class="btn btn-xs btn-warning text-white py-1 mx-1 shadow" title="Editar">
                                                                    <i class="fa fa-lg fa-fw fa-pen"></i>
                                                                </button>
                                                            </a>
                                                            <button class="btn btn-xs btn-danger btn-delete text-white py-1 mx-1 shadow" title="Eliminar">
                                                                <i class="fa fa-lg fa-fw fa-trash"></i>
                                                            </button>
                                                            {{-- <form action="" class="d-none form-delete" method="post">
                                                                @csrf @method("DELETE")
                                                                <input type="submit" value="Send" class="d-none">
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                                    {{-- TODO: cambiar el color al azul mas intenso --}}
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <button class="btn btn-xs btn-primary text-white py-2 px-3 shadow" title="Generar plan">
                                            <span>Generar plan</span>
                                        </button>
                                    </div>
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <button type="submit" class="btn btn-xs btn-success text-white py-2 px-3 shadow" title="Enviar">
                                            <i class="fa fa-arrow-circle-right fa-lg"></i>
                                            <span>Enviar</span>
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
