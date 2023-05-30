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
                                <div class="d-flex">
                                    <div class="d-flex flex-column mt-4 ml-auto mr-2">
                                        <a href="{{ route('restorationPlan.index') }}" class="btn btn-xs btn-danger text-white py-2 px-3 shadow">
                                            <span>Atrás</span>
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column mt-4 mr-2">
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
