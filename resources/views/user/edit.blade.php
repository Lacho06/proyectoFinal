@extends('adminlte::page')
@section('content_header')
    <h2>Editar usuario</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    <div class="row">
        <div class="col-12 col-md-8 d-flex m-0 p-0">
            <div class="col-12 card m-0 ml-3 mb-4 py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <form action="{{ route('user.update', $user) }}" enctype="multipart/form-data" method="POST" class="form">
                            @csrf @method('PUT')
                            <div class="d-flex flex-column">
                                <div class="d-flex">
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="name" label="Nombre" placeholder="Nombre..." value="{{ old('name', $user->name) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input name="lastname" label="Apellido" placeholder="Apellido..." value="{{ old('lastname', $user->lastname) }}" label-class="text-lightblue">
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
                                        <x-adminlte-input name="email" label="Correo" placeholder="Correo..." value="{{ old('email', $user->email) }}" label-class="text-lightblue">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="fa fa-envelope text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                        </x-adminlte-input>
                                    </div>
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-input type="text" name="phone" label="Teléfono" placeholder="Teléfono..." value="{{ old('phone', $user->phone) }}" label-class="text-lightblue">
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
                                        <x-adminlte-input name="solapin" label="Solapín" placeholder="Solapín..." value="{{ old('solapin', $user->solapin) }}" label-class="text-lightblue">
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
                                    <div class="d-flex flex-column my-1 mx-4">
                                        <x-adminlte-select2 name="role" label="Rol" data-placeholder="Rol..." label-class="text-lightblue"
                                            igroup-size="md">
                                            <x-slot name="prependSlot">
                                                <div class="input-group-text">
                                                    <i class="far fa-chart-bar text-lightblue"></i>
                                                </div>
                                            </x-slot>
                                            {{-- <option>Seleccione una opción</option> --}}
                                            <option @selected($user->role === 'administrador') value="administrador">Administrador</option>
                                            <option @selected($user->role === 'vicerector') value="vicerector">Vicerrector</option>
                                            <option @selected($user->role === 'asistente') value="asistente">Asistente del vicerrector</option>
                                            <option @selected($user->role === 'comunidad_universitaria') value="comunidad universitaria">Comunidad universitaria</option>
                                        </x-adminlte-select2>
                                    </div>
                                </div>
                                <div class="d-flex my-1">
                                    <div class="d-flex flex-column mt-4 ml-auto mr-2">
                                        <a href="{{ route('user.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                            <span>Atrás</span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column mt-4 mx-2">
                                        <button type="submit" class="btn btn-xs btn-warning text-white py-2 px-3 shadow" title="Editar">
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
