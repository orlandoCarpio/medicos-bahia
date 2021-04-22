@extends('layout.layoutMedico')
@section('contenido')
    <div class="container" id="medico-contenedor">
        
        <input type="date" id="fecha-me" value="{{date('Y-m-d')}}">
        <input type="hidden"id="idMed" value="">
        <div id="horario-grid"></div>
    </div>
    @include('modal')
@endsection