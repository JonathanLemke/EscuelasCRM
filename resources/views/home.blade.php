@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <!-- two columns cards -->
                    <!-- the cards have a image to represent the area -->
                    <!-- the cards have a title -->
                    <!-- the cards have a description -->
                    <!-- the cards link to route list of especific area -->
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('school_icon.jpeg') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title"><a href="{{ route('schools.index') }}"> Schools </a></h5>
                                    <p class="card-text"> Ver la lista de escuelas </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('student_icon.jpeg') }}" class="card-img-top" alt="...">
                                    <h5 class="card-title"><a href="{{ route('students.index') }}"> Students </a></h5>
                                    <p class="card-text"> Ver la lista de alumnos </p>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
