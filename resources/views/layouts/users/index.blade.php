@extends('layouts.panel')

@section('page')
    @php $currentPage = 'users' @endphp
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title mb-0">Lista de Usuarios</h2>
                <p class="card-text">Administra y visualiza la lista de usuarios</p>
            </div>

            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="{{ route('users.create') }}" class="btn btn-success">Crear Nuevo Usuario</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th class="text-right">Correo Electrónico</th>
                                <th class="text-right">Teléfono</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td class="text-right">{{ $user->email }}</td>
                                    <td class="text-right">{{ $user->phone_number }}</td>
                                    
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                                                <i class="zmdi zmdi-edit"></i> Editar
                                            </a>
                                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                    <i class="zmdi zmdi-delete"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
