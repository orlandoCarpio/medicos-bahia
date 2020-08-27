@extends('layout.layout')
@section('contenido')
<div class="container">    
    <div class="container "id="container-turno" >
        <h2 class="text-center">Solicitud de Turno</h2>
        <div class="row" id="datos-medico">
            <div class="col col-sm">
                <div class="cont-turn">
                    
                    <u><h4 class="card-title">Datos</h4></u>
                    <p><span class="turno-title"> Apellido y Nombre:</span> {{$datos[0]->apellido}} {{$datos[0]->nombre}}</p>
                    <p><span class="turno-title">Especialidad:</span> {{$datos[0]->descripcion}}</p>
                    <p ><span class="turno-title">Direccion:</span> {{$datos[0]->calle}} {{$datos[0]->numero}}
                        @if(!empty($datos[0]->piso))
                            , Piso: {{$datos[0]->piso}}, Oficina: {{$datos[0]->oficina}}
                        @endif    
                    </p>
                    <p><span class="turno-title">Teléfono:</span> 345234534</p>
                </div>
            </div>
            <div class="col col-sm">
                <div class="cont-turn">
                    <u><h4 class="card-title">Horarios</h4></u>
                    @php
                        $dias=array(1=>'Lunes',2=>'Martes',3=>'Miércoles',4=>'Jueves',5=>'Viernes',6=>'Sábado');
                        $diasH=array();
                    @endphp
                    @foreach ( $horarios as $h )
                        <p ><span class="turno-title"> {{$dias[$h->dia]}}:</span> {{date('H:i',strtotime($h->hora_entrada_M))}} a {{date('H:i',strtotime($h->hora_salida_M))}} 
                        @if($h->hora_entrada_T!='00:00:00')
                            y {{date('H:i',strtotime($h->hora_entrada_T))}} a {{date('H:i',strtotime($h->hora_salida_T))}}</p>    
                        @endif    
                        @php
                            $diasH[]=$h->dia;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container" id="horarios-cont-grid">
        <div class="row" id="date-grid">
            <input type="date" class="form-control col-sm-6" id="fecha-t" value="{{date('Y-m-d')}}">
            <input type="hidden"id="idMed" value="{{$datos[0]->iddoc}}">
            <input type="hidden"id="dias" value="{{json_encode($diasH)}}">
        </div>
        <div id='mensajesl'></div>
        <div class="row" id="horario-grid">
            
        </div>
    </div>
</div>    
    @include('modal')
@endsection