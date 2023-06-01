@extends('adminlte::page')
@section('content_header')
    <h2>Autores</h2>
    <div class="mb-3"></div>
@endsection
@section('content')

    @php
        $heads = [
            ['label' => 'ID', 'width' => 10],
            ['label' => 'Nombre', 'width' => 20],
            ['label' => 'Apellidos', 'width' => 20],
            ['label' => 'Correo', 'width' => 20],
            ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
        ];
    @endphp
    <div class="d-flex mb-4">
        <a href="{{ route('author.create') }}" class="ml-auto">
            <button class="btn btn-xs btn-success text-white py-2 px-3 mx-1 shadow" title="Agregar">
                <i class="fa fa-plus"></i>
                <span>Crear</span>
            </button>
        </a>
    </div>
    <x-adminlte-datatable id="table1" :heads="$heads" striped hoverable beautify>
        @forelse($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->lastname }}</td>
                <td>{{ $author->email }}</td>
                <td class="d-flex justify-content-center">
                    <a href="{{ route('author.show', $author) }}">
                        <button class="btn btn-xs btn-success text-white py-1 mx-1 shadow" title="Ver">
                            <i class="fa fa-lg fa-fw fa-eye"></i>
                            <span>Ver</span>
                        </button>
                    </a>
                    <a href="{{ route('author.edit', $author) }}">
                        <button class="btn btn-xs btn-warning text-white py-1 mx-1 shadow" title="Editar">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                            <span>Editar</span>
                        </button>
                    </a>
                    <button class="btn btn-xs btn-danger btn-delete text-white py-1 mx-1 shadow" title="Eliminar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                        <span>Eliminar</span>
                    </button>
                    <form action="{{ route('author.destroy', $author) }}" class="d-none form-delete" method="post">
                        @csrf @method("DELETE")
                        <input type="submit" value="Send">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td>No hay autores para mostrar</td>
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
                    title: '¿Estás seguro que deseas eliminar este autor?',
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
                        'Este autor ha sido eliminado.'
                        )
                    }
                })
            })
        })
    </script>

@endsection
