@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Detalles de la escuela</h2>
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
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $school->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="endereco">Dirección</label>
            <input type="text" name="endereco" id="endereco" class="form-control" value="{{ $school->address }}" readonly>
        </div>
        <div class="form-group">
            <label for="logo">Logotipo</label><br>
            @if (Storage::disk('public')->exists('logos/' . basename($school->logo))) <a href="{{ $school->logo }}" target="_blank"><img src="{{ asset($school->logo) }}" alt="{{ $school->name }}" width="100"></a> @else <a href="{{ asset('storage/default_logo.jpeg') }}" target="_blank"><img src="{{ asset('storage/default_logo.jpeg') }}" alt="{{ $school->name }}" width="100"></a>@endif
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $school->email }}" readonly>
        </div>
        <div class="form-group">
            <label for="telefone">Telefono</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $school->phone_number }}" readonly>
        </div>
        <div class="form-group">
            <label for="pagina_web">Página Web</label>
            <input type="text" name="pagina_web" id="pagina_web" class="form-control" value="{{ $school->web_page }}" readonly>
        </div>
        <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection
