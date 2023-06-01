@extends('adminlte::page')
@section('content_header')
    <h2>Crear Autor</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('author.store') }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="name" label="Nombre" placeholder="Nombre..." value="{{ old('name') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="lastname" label="Apellidos" placeholder="Apellidos..." value="{{ old('lastname') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="email" label="Correo" placeholder="Correo..." value="{{ old('email') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-envelope text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input type="text" name="phone" label="Teléfono" placeholder="Teléfono..." value="{{ old('phone') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-phone text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex my-1">
                                    <div class="d-flex flex-column ml-auto mr-2">
                                        <a href="{{ route('author.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                            <span>Atrás</span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column">
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
