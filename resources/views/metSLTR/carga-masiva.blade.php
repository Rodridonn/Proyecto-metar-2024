@extends('layouts.panel')

@section('content')

    <form action="{{ route('carga-masiva') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="archivo_csv" accept=".csv">
        <button type="submit">Cargar</button>
    </form>

@endsection
