@extends('adminlte::page')
@section('content_header')
    <h2>Crear Obra</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('culturalWork.store') }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="title" label="Título" placeholder="Título..." value="{{ old('title') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-bold text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input type="number" name="year_of_stablishment" label="Año de instauración" placeholder="Año de instauración..." value="{{ old('year_of_stablishment') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-calendar-alt text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="location" label="Ubicación" placeholder="Ubicación..." value="{{ old('location') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-select2 name="restore_permission" label="Permiso de restauración" data-placeholder="Permiso de restauración..." value="{{ old('restore_permission') }}" label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock-open text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option default value="Seleccione una opción">Seleccione una opción</option>
                                            <option value="autor">autor</option>
                                            <option value="universidad">universidad</option>
                                            <option value="no">no</option>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-select2 name="state_of_disrepair" label="Estado de deterioro" data-placeholder="Estado de deterioro..." value="{{ old('state_of_disrepair') }}" label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-chart-bar text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option default value="Seleccione una opción">Seleccione una opción</option>
                                            <option value="óptimo">óptimo</option>
                                            <option value="regular">regular</option>
                                            <option value="deteriorado">deteriorado</option>
                                        </x-adminlte-select2>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-select2 name="author" label="Autor" label-class="text-lightblue"
                                            igroup-size="md" data-placeholder="Seleccione una opción...">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-user-circle text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option default value="Seleccione una opción">Seleccione una opción</option>
                                            @forelse ($authors as $author)
                                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                            @empty
                                                <option>No hay autores disponibles</option>
                                            @endforelse
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-textarea name="review" label="Reseña" rows=8 igroup-size="sm"
                                            label-class="text-primary" value="{{ old('review') }}" placeholder="Reseña..." disable-feedback>
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-align-justify text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-textarea>
                                    </div>
                                </div>
                                <div class="d-flex mx-4 my-1">
                                    <div class="d-flex flex-column bg-info">
                                        <x-adminlte-input-file name="image" label="Imagen" label-class="text-lightblue" placeholder="Imagen..." value="{{ old('image') }}" disable-feedback></x-adminlte-input-file>
                                        <div class="image-container" style="width: 100%; height: 60%; aspect-ratio: 4/4; display: flex; border: 0.1px solid gray; z-index: 5;">
                                            <span class="m-auto">No hay ninguna imagen seleccionada</span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column mx-4">
                                        <x-adminlte-input type="number" name="budget" label="Presupuesto" placeholder="Presupuesto..." value="{{ old('budget') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between ml-auto my-3">
                                    <div class="d-flex flex-column my-1">
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
