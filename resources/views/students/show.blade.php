@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de lo alumno</h2>
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
        <div class="form-group">
            <label for="nome">Nombre</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $student->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $student->lastname }}" readonly>
        </div>
        <div class="form-group">
            <label for="escuela">Escuela</label>
            <input type="text" name="escuela" id="escuela" class="form-control" value="{{ $student->school->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="fecha de nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha de nacimiento" id="fecha de nacimiento" class="form-control" value="{{ $student->birth_date }}" readonly>
        </div>
        <div class="form-group">
            <label for="ciudad natal">Ciudad natal</label>
            <input type="text" name="ciudad natal" id="ciudad natal" class="form-control" value="{{ $student->hometown }}" readonly>
        </div>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection
