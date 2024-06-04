@extends('layouts.panel')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-center text-white">
                    <h1 class="my-3">CREAR NUEVO USUARIO</h1>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="first_name">Nombre:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nombre" value="{{ old('first_name') }}">
                        </div>

                        <div class="form-group">
                            <label for="last_name">Apellido:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Correo electrónico:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Número de teléfono:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Número de teléfono" value="{{ old('phone_number') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirmar Contraseña:</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
