@extends('adminlte::page')
@section('content_header')
    <h2>Detalles de autor</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @if (Session::has('message'))
        <div class="d-none message">{{ Session::get('message') }}</div>
    @endif

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 py-3 px-5">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <div class="d-flex flex-column px-4 mt-3 mb-auto">
                            <img class="rounded-circle border border-dark" width="80" height="80" src="{{ asset('src/icons/user.png') }}" alt="{{ $author->name }}">
                        </div>
                        <div class="d-flex flex-column my-auto">
                            <div class="d-flex my-1 w-100">
                                <h3 class="my-auto mx-3">Nombre:</h3>
                                <div class="border border-dark px-3 py-1 flex-wrap my-2 w-100 ml-auto" style="width: 250px !important;">
                                    <p class="my-auto">{{ $author->name }}</p>
                                </div>
                            </div>
                            <div class="d-flex my-1 w-100">
                                <h3 class="my-auto mx-3">Apellidos:</h3>
                                <div class="border border-dark px-3 py-1 flex-wrap my-2 w-100 ml-auto" style="width: 250px !important;">
                                    <p class="my-auto">{{ $author->lastname }}</p>
                                </div>
                            </div>
                            <div class="d-flex my-1 w-100">
                                <h3 class="my-auto mx-3">Correo:</h3>
                                <div class="border border-dark px-3 py-1 flex-wrap my-2 w-100 ml-auto" style="width: 250px !important;">
                                    <p class="my-auto">{{ $author->email }}</p>
                                </div>
                            </div>
                            <div class="d-flex my-1 w-100">
                                <h3 class="my-auto mx-3">Teléfono:</h3>
                                <div class="border border-dark px-3 py-1 flex-wrap my-2 w-100 ml-auto" style="width: 250px !important;">
                                    <p class="my-auto">{{ $author->phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex my-1">
                        <div class="d-flex flex-column mt-4 ml-auto mr-2">
                            <a href="{{ route('author.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                <span>Atrás</span>
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
