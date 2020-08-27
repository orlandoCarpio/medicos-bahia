@extends('layout.layoutMedico')
@section('contenido')
    <div class="container" id="medico-contenedor">
        <input type="date" id="fecha-me" value="{{date('Y-m-d')}}">
    </div>
    @include('modal')
@endsection