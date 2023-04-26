@extends('adminlte::page')
@section('content_header')
    <h2>Planes de restauración</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @php
        $heads = [
            ['label' => 'ID', 'width' => 10],
            ['label' => 'Año', 'width' => 20],
            ['label' => 'Presupuesto anual', 'width' => 20],
            ['label' => 'Aprobación', 'width' => 20],
            ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
        ];
    @endphp
    <div class="d-flex mb-4">
        <a href="{{ route('restorationPlan.create') }}" class="ml-auto">
            <button class="btn btn-xs text-white py-2 px-3 mx-1 shadow" style="background-color: #202A62;" title="Generar Reporte">
                <span>Generar Reporte</span>
            </button>
        </a>
        <a href="{{ route('restorationPlan.create') }}">
            <button class="btn btn-xs btn-success text-white py-2 px-3 mx-1 shadow" title="Agregar">
                <i class="fa fa-plus"></i>
                <span>Agregar</span>
            </button>
        </a>
    </div>
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify>
        @forelse($plans as $plan)
            <tr>
                <td>{{ $plan->id }}</td>
                <td>{{ $plan->year }}</td>
                <td>{{ $plan->annual_budget }} CUP</td>
                <td>
                    @if ($plan->approval == 1)
                        aprobado
                    @else
                        no aprobado
                    @endif
                </td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('restorationPlan.show', $plan->id) }}">
                        <button class="btn btn-xs btn-success text-white py-1 mx-1 shadow" title="Ver">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                            <span>Ver</span>
                        </button>
                    </a>
                    <a href="{{ route('restorationPlan.edit', $plan->id) }}">
                        <button class="btn btn-xs btn-warning text-white py-1 mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                            <span>Editar</span>
                        </button>
                    </a>
                    <button class="btn btn-xs btn-danger btn-delete text-white py-1 mx-1 shadow" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                        <span>Eliminar</span>
                    </button>
                    <form action="{{ route('restorationPlan.destroy', $plan) }}" class="d-none form-delete" method="post">
                        @csrf @method("DELETE")
                        <input type="submit" value="Send">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>No hay planes de restauración para mostrar</td>
            </tr>
        @endforelse
    </x-adminlte-datatable>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const forms = document.querySelectorAll('.form-delete')
        const btns = document.querySelectorAll('.btn-delete')
        btns.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                const form = forms[index];
                Swal.fire({
                    title: '¿Estás seguro que deseas eliminar este plan de restauración?',
                    text: "No puedes revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, acepto'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit()
                        Swal.fire(
                        'Eliminado',
                        'Este plan de restauración ha sido eliminado.'
                        )
                    }
                })
            })
        })
    </script>

@endsection
