@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($schools) ? 'Editar escuela' : 'Nueva Escuela' }}{{session('error')}}</h2>

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

        <form action="{{ isset($schools) ? route('schools.update', $schools->id) : route('schools.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($schools))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="nome">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ isset($schools) ? $schools->name : old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="endereco">Dirección</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ isset($schools) ? $schools->address : old('address') }}" required>
            </div>
            <div class="form-group">
                <label for="logo">Logotipo</label>

                @if (isset($schools) and $schools->logo)
                    <br><br>
                    <a href="{{ $schools->logo }}" target="_blank"><img src="{{ asset($schools->logo) }}" alt="{{ $schools->name }}" width="100"></a>
                @else
                    <br><br>
                    <img src="{{ asset('storage/default_logo.jpeg') }}" width="100">
                @endif
                <input type="file" name="logo" id="logo" class="form-control" value="{{ isset($schools) ? $schools->logo : old('logo') }}">
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ isset($schools) ? $schools->email : old('email') }}">
            </div>
            <div class="form-group">
                <label for="telefone">Telefono</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ isset($schools) ? $schools->phone_number : old('phone_number') }}">
            </div>
            <div class="form-group">
                <label for="pagina_web">Página Web</label>
                <input type="text" name="web_page" id="web_page" class="form-control" value="{{ isset($schools) ? $schools->web_page : old('web_page') }}">
            </div>
            <button type="submit" class="btn btn-primary"> {{ isset($schools) ? 'Editar' : 'Agregar' }} </button>
        </form>
    </div>
@endsection
