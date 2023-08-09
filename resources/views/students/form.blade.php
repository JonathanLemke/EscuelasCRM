@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ isset($students) ? 'Editar alumno' : 'Agregar alumno' }}{{session('error')}}</h2>

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

        <form action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($student))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="nome">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ isset($student) ? $student->name : old('name') }}" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ isset($student) ? $student->lastname : old('lastname') }}" required>
            </div>
            <div class="form-group">
                <label for="escuela">Escuela</label>

                <select name="school_id" id="school_id" class="form-control">

                    @foreach ($schools as $school)

                        <option value="{{$school->id}}" {{isset($student) && $school->id == $student->school->id ? 'selected=selected' : ''}}>{{$school->name}}</option>
                    @endforeach

                </select>

            </div>
            <div class="form-group">
                <label for="fecha de nacimiento">Fecha de nacimiento</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ isset($student) ? $student->birth_date : old('birth_date') }}" required>
            </div>
            <div class="form-group">
                <label for="ciudad natal">Ciudad natal</label>
                <input type="text" name="hometown" id="hometown" class="form-control" value="{{ isset($student) ? $student->hometown : old('hometown') }}">
            </div>
            <button type="submit" class="btn btn-primary"> {{ isset($student) ? 'Editar' : 'Agregar' }} </button>
        </form>
    </div>
@endsection
