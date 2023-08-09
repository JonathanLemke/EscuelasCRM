@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Escuelas</h2>
        <a href="{{ route('schools.create') }}" class="btn btn-primary">Agregar Escuela</a>
        <!-- sussess and error messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Logotipo</th>
                <th>Correo electrónico</th>
                <th>Telefono</th>
                <th>Página Web</th>
                <th class="w-22 text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($schools as $school)
                <tr>
                    <td>{{ $school->name }}</td>
                    <td>{{ $school->address }}</td>
                    <td>
                        @if ($school->logo
                            and Storage::disk('public')->exists('logos/' . basename($school->logo)))
                            <a href="{{ $school->logo }}" target="_blank">
                                <img src="{{ asset($school->logo) }}" alt="{{ $school->name }}" width="50">
                            </a>
                        @else
                            <a href="{{ asset('storage/default_logo.jpeg') }}" target="_blank">
                                <img src="{{ asset('storage/default_logo.jpeg') }}" alt="{{ $school->name }}" width="50">
                            </a>
                        @endif
                    </td>
                    <td>{{ $school->email }}</td>
                    <td>{{ $school->phone_number }}</td>
                    <td>
                        <a href="{{ $school->web_page }}" target="_blank" title="{{ $school->web_page }}" >Pagina Web</a>
                    </td>
                    <td>
                        <a href="{{ route('schools.show', $school->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este registro?')">Eliminar</button>
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
        @if (!$schools->onFirstPage())
            <a href="{{ $schools->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
        @endif
        <div class="mx-2 h5 px-2">
            <!-- current page -->
            {{ $schools->currentPage() }}
            <!-- total pages -->
            de {{ $schools->lastPage() }}
        </div>
        <!-- next button -->
        @if( !$schools->onLastPage())
        <a href="{{ $schools->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
        @endif

    </div>


@endsection
