@php

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hoy=strtotime(date('Y-m-d H:i:s'));
    date_default_timezone_set('UTC');
    //date_default_timezone_get()
@endphp
    <div class="row">
        <u><h2>Listado de Turnos</h2></u>
    </div>
    <div class="row">
        <input type="date" id="fecha-m" class="form-control">
    </div>
    <div class="row horarios-m" >
        <div class="col-sm-6">  
        
            <u><h3>Turno mañana</h3></u>
           
            @for($i=strtotime($horario->hora_entrada_M);$i<=strtotime($horario->hora_salida_M);$i=strtotime('+30 minute',$i))
                @php                    
                    $h=date('H:i:s',$i);
                    $time=$fecha.' '.$h;
                    $date=date('Y-m-d H:i:s',strtotime($time));
                @endphp                
                {{strtotime($time)}}
                {{$hoy}}
                @if( in_array($h , $turnos) || $hoy > strtotime($time)) 
                    @php
                        $e=array_search($h,$turnos );
                        $apellido=$e>0?$datos[$e]->apellido:"";
                        $nombre=$e>0?$datos[$e]->nombre:"";
                    @endphp

                    <p class="horas-g ocupado">{{$h}} {{$apellido}} {{$nombre}}</p>
                @else
                    <p class="horas-g libre">{{$h}}</p>
                @endif        

            @endfor
        </div>
        <div class="col-sm-6">
            <u><h3>Turno tarde</h3></u>
        </div>
    </div>    

<div></div>