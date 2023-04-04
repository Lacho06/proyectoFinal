@extends('adminlte::page')
@section('content')

    <h2>Bienvenido a la zona administrativa {{ auth()->user()->name }}</h2>
    <div class="row">
        <div class="d-flex justify-content-around col-12">
            <div class="d-flex flex-column">
                <h4>Últimos usuarios</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-stripped">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                        </tr>
                        @forelse($users as $user)
                            <tr class="table-hover">
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                        @empty
                            <tr class="table-hover">
                                <td>No hay usuarios para mostrar</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h4>Últimas obras</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-stripped">
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                        </tr>
                        @forelse($culturalWorks as $culturalWork)
                            <tr class="table-hover">
                                <td>{{ $culturalWork->id }}</td>
                                <td>{{ $culturalWork->title }}</td>
                            </tr>
                        @empty
                            <tr class="table-hover">
                                <td>No hay obras para mostrar</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="d-flex flex-column">
                <h4>Últimos autores</h4>
                <div class="table-responsive">
                    <table class="table table-dark table-stripped">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                        </tr>
                        @forelse($authors as $author)
                            <tr class="table-hover">
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                            </tr>
                        @empty
                            <tr class="table-hover">
                                <td>No hay autores para mostrar</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>

        </div>
    </div>



@endsection
