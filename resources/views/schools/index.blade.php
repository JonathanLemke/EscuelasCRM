@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Escuelas</h2>
        <a href="" class="btn btn-primary">Agregar Escuela</a>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Logotipo</th>
                <th>Correo electrónico</th>
                <th>Telefono</th>
                <th>Página Web</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->address }}</td>
                    <td>@if ($school->logo) <a href="storage/{{ $school->logo }}" target="_blank"><img src="{{ asset('storage/' . $school->logo) }}" alt="{{ $school->name }}" width="50"></a> @else <a href="{{ asset('storage/default_logo.jpeg') }}" target="_blank"><img src="{{ asset('storage/default_logo.jpeg') }}" alt="{{ $school->name }}" width="50"></a>@endif</td>
                    <td>{{ $school->email }}</td>
                    <td>{{ $school->phone_number }}</td>
                    <td>
                        <a href="{{ $school->web_page }}" target="_blank" title="{{ $school->web_page }}" >Pagina Web</a>
                    </td>
                    <td>
                        <a href="" class="btn btn-info btn-sm">Ver</a>
                        <a href="" class="btn btn-primary btn-sm">Editar</a>
                        <form action="" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    </div>
    <!-- pagination laravel custom -->
    <div class="d-flex  justify-content-center align-items-center items-center">
        <!-- previus button -->
        <a href="{{ $schools->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        <div class="mx-2 h5 px-2">
        <!-- current page -->
        {{ $schools->currentPage() }}
        <!-- total pages -->
        de {{ $schools->lastPage() }}
        </div>
        <!-- next button -->
        <a href="{{ $schools->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>

    </div>


@endsection
