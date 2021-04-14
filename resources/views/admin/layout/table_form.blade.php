@extends('admin.layout.master')

@section('content')

    <div class="admin-faq-container">

        <div class="formulario" id="form">
            @yield('form')
        </div>

        <div class="tabla" id="table">
            @yield('table')
        </div>

    </div>

@endsection