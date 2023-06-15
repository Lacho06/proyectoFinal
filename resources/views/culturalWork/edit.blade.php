@extends('adminlte::page')
@section('content_header')
    <h2>Editar obra</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('culturalWork.update', $culturalWork) }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf @method('PUT')
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-input name="title" label="Título" placeholder="Título..." value="{{ old('title', $culturalWork->title) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-bold text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-input type="number" name="year_of_stablishment" label="Año de instauración" placeholder="Año de instauración..." value="{{ old('year_of_stablishment', $culturalWork->year_of_stablishment) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-calendar-alt text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-input name="location" label="Ubicación" placeholder="Ubicación..." value="{{ old('location', $culturalWork->location) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-map-marker-alt text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-select2 name="restore_permission" label="Permiso de restauración" label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-lock-open text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option disabled selected value="">Seleccione una opción</option>
                                            <option value="autor" @selected($culturalWork->restore_permission == 'autor')>autor</option>
                                            <option value="universidad" @selected($culturalWork->restore_permission == 'universidad')>universidad</option>
                                            <option value="no" @selected($culturalWork->restore_permission == 'no')>no</option>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-select2 name="state_of_disrepair" label="Estado de deterioro" label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-chart-bar text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option disabled selected value="">Seleccione una opción</option>
                                            <option value="óptimo" @selected($culturalWork->state_of_disrepair == 'óptimo')>óptimo</option>
                                            <option value="regular" @selected($culturalWork->state_of_disrepair == 'regular')>regular</option>
                                            <option value="deteriorado" @selected($culturalWork->state_of_disrepair == 'deteriorado')>deteriorado</option>
                                        </x-adminlte-select2>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-select2 name="author_id" label="Autor" label-class="text-lightblue"
                                            igroup-size="md" data-placeholder="Seleccione una opción...">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-user-circle text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option disabled selected value="">Seleccione una opción</option>
                                            @forelse ($authors as $author)
                                                <option value="{{ $author->id }}"
                                                    @if ($culturalWork->author)
                                                        @selected($culturalWork->author->id == $author->id)
                                                    @endif
                                                >{{ $author->name }}</option>
                                            @empty
                                                <option disabled>No hay autores disponibles</option>
                                            @endforelse
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column my-1 mx-4 w-100">
                                        <x-adminlte-textarea name="review" label="Reseña" rows=8 igroup-size="sm"
                                            label-class="text-primary" placeholder="Reseña...">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-align-justify text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            {{ old('review', $culturalWork->review) }}
                                        </x-adminlte-textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column mx-4 w-100">
                                        <x-adminlte-input-file name="image" class="image-value" label="Imagen" label-class="text-lightblue" placeholder="Imagen..." value="{{ old('image', $culturalWork->image) }}"></x-adminlte-input-file>
                                        <div style="aspect-ratio: 1/1; display: flex; border: 1px solid rgba(128, 128, 128, .5); z-index: 5;">
                                            <img class="image-container" style="aspect-ratio: 1/1; max-width: 300px; max-height: 300px;" src="{{ old('image', Storage::url($culturalWork->image)) }}" alt="No hay ninguna imagen seleccionada">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column mx-4 w-100">
                                        <x-adminlte-input type="number" name="budget" label="Presupuesto" placeholder="Presupuesto..." value="{{ old('budget', $culturalWork->budget) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-dollar-sign text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex my-1">
                                    <div class="d-flex flex-column mt-4 ml-auto mr-2">
                                        <a href="{{ route('culturalWork.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
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
    <script>
        const $seleccionArchivos = document.querySelector(".image-value"),
        $imagenPrevisualizacion = document.querySelector(".image-container");

        // Escuchar cuando cambie
        $seleccionArchivos.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
        });
    </script>
@endsection
