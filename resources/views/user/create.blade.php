@extends('adminlte::page')
@section('content_header')
    <h2>Crear Usuario</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('user.store') }}" enctype="multipart/form-data" method="POST" class="form">
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
                                        <x-adminlte-input type="number" name="phone" label="Teléfono" placeholder="Teléfono..." value="{{ old('phone') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-phone text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="solapin" label="Solapín" placeholder="Solapín..." value="{{ old('solapin') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-id-card text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input type="password" name="password" label="Contraseña" placeholder="Contraseña..." value="{{ old('password') }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-key text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mx-4 my-3">
                                    <div class="d-flex flex-column mb-auto">
                                        <x-adminlte-select2 name="role" label="Rol" data-placeholder="Rol..." value="{{ old('role') }}" label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-chart-bar text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            <option default value="Seleccione una opción">Seleccione una opción</option>
                                            <option value="administrador">Administrador</option>
                                            <option value="vicerector">Vicerrector</option>
                                            <option value="asistente">Asistente del vicerrector</option>
                                            <option value="comunidad universitaria">Comunidad universitaria</option>
                                        </x-adminlte-select2>
                                    </div>
                                    <div class="d-flex my-1">
                                        <div class="d-flex flex-column mt-4 ml-auto mr-2">
                                            <a href="{{ route('user.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                                <span>Atrás</span>
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column mt-4 mx-2">
                                            <button type="submit" class="btn btn-xs btn-success text-white py-2 px-3 shadow" title="Enviar">
                                                <i class="fa fa-arrow-circle-right fa-lg"></i>
                                                <span>Enviar</span>
                                            </button>
                                        </div>
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
