@extends('layouts.panel')

@section('page')
    @php $currentPage = 'users' @endphp
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title mb-0">Editar Usuario</h2>
                <p class="card-text">Modifica la información del usuario</p>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="first_name">Nombre:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <div class="form-group">
                        <label for="last_name">Apellido:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Teléfono:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Dejar en blanco para mantener la contraseña actual">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Dejar en blanco para mantener la contraseña actual">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
