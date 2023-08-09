@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de alumnos</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Agregar Alumnos</a>
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
        <!-- filtrado por escuela -->
        <form action="{{ route('students.index') }}" method="GET" class="mt-3">
            <div class="form-group">
                <label for="escuela">Filtrar por Escuela</label>
                <select name="escuela" id="escuela" class="form-control mb-3 ">
                    <option value="">Todos</option>
                    @foreach ($schools as $school)
                        <option value="{{ $school->id }}" {{ request()->get('escuela') == $school->id ? 'selected=selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Escuela</th>
                <th>Fecha de nacimiento</th>
                <th>Ciudad natal</th>
                <th class="w-22 text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->lastname }}</td>
                    <td>{{ $student->school->name }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->hometown }}</td>
                    <td>
                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
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
        @if (!$students->onFirstPage())
            @if (request()->get('escuela'))
                <a href="{{ $students->previousPageUrl() . '&escuela=' . request()->get('escuela') }}" class="btn btn-primary">Anterior</a>
            @else
                <a href="{{ $students->previousPageUrl() }}" class="btn btn-primary">Anterior</a>
            @endif
        @endif
        <div class="mx-2 h5 px-2">
            <!-- current page -->
            {{ $students->currentPage() }}
            <!-- total pages -->
            de {{ $students->lastPage() }}
        </div>
        <!-- next button -->
        @if( !$students->onLastPage())
            <!-- pagination with filter -->
            @if (request()->get('escuela'))
                <a href="{{ $students->nextPageUrl() . '&escuela=' . request()->get('escuela') }}" class="btn btn-primary">Siguiente</a>
            @else
                <a href="{{ $students->nextPageUrl() }}" class="btn btn-primary">Siguiente</a>
            @endif

        @endif

    </div>


@endsection
