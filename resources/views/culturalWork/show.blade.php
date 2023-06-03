@extends('adminlte::page')
@section('content_header')
    <h2>Detalles de obra</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @if (Session::has('message'))
        <div class="d-none message">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-12 card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="d-flex flex-column mx-auto">
                        <h3>Título:</h3>
                        <p class="text-center">{{ $culturalWork->title }}</p>
                        @if ($culturalWork->image)
                            <img src="{{ Storage::url($culturalWork->image) }}" class="card-image" alt="Imagen de la obra {{ $culturalWork->title }}">
                        @endif
                        <h3>Reseña:</h3>
                        <p class="mx-auto p-5 border">{{ $culturalWork->review }}</p>
                    </div>
                </div>
                <div class="d-flex justify-content-around p-3">
                    <div class="d-flex flex-column">
                        <p>Ubicación: <span>{{ $culturalWork->location }}</span></p>
                        <p>Autor:
                            @if ($culturalWork->author)
                                <span>{{ $culturalWork->author->name }}</span>
                            @endif
                        </p>
                        {{-- TODO: pendiente agregar la puntuacion --}}
                        <p>Popularidad media: <span>puntuacion</span></p>
                        <p>Presupuesto: <span>{{ $culturalWork->budget }}</span></p>
                    </div>
                    <div class="d-flex flex-column">
                        <p>Año de instauración: <span>{{ $culturalWork->year_of_stablishment }}</span></p>
                        <p>Permiso de restauración: <span>{{ $culturalWork->restore_permission }}</span></p>
                        <p>Estado de deterioro: <span>{{ $culturalWork->state_of_disrepair }}</span></p>
                    </div>
                </div>
                {{-- <div class="d-flex justify-content-around mx-3">
                    <table class="table table-bordered mx-5">
                        <tr>
                            <th>Restauraciones pasadas</th>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                    <table class="table table-bordered mx-5">
                        <tr>
                            <th>Restauraciones futuras</th>
                        </tr>
                        <tr>

                        </tr>
                    </table>
                </div> --}}
                <div class="d-flex my-1">
                    <div class="d-flex flex-column mt-4 ml-auto mr-2">
                        <a href="{{ route('culturalWork.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                            <span>Atrás</span>
                        </a>
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
