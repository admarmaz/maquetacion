@extends('admin.layout.master')

@section('content')

    <div class="pantalla50">
        <div class="tabla" id="table">
            @yield('table')
        </div>

        <div class="formulario" id="form">
            @yield('form')
        </div>
    </div>

@endsection