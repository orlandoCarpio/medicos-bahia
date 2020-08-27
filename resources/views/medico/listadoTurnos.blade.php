@php
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hoy=strtotime(date('Y-m-d H:i:s'));
    date_default_timezone_set('UTC');
@endphp
    <div class="row">
        <u><h2>Listado de Turnos</h2></u>
    </div>
    <div class="row">
        <input type="date" id="fecha-m" class="form-control">
    </div>
    <div id="horarios-m" class="row horarios-m" >
        <div class="col-sm-6">  
            <u><h3>Turno mañana</h3></u>           
            @for($i=strtotime($horario->hora_entrada_M);$i<=strtotime($horario->hora_salida_M);$i=strtotime('+30 minute',$i))
                @php                    
                    $h=date('H:i:s',$i);
                    $time=$fecha.' '.$h;
                    $date=date('Y-m-d H:i:s',strtotime($time));
                    $buscar_hora=array_search($h,$turnos );
                    $apellido=$buscar_hora>0?$datos[$buscar_hora]->apellido:"";
                    $nombre=$buscar_hora>0?$datos[$buscar_hora]->nombre:"";
                    $clase=$buscar_hora>0?'reservado':'libre';
                    $clase=$buscar_hora>0 && $datos[$buscar_hora]->estado=='atendido'?"ocupado":$clase; 
                    $boton=$buscar_hora>0 && $datos[$buscar_hora]->estado!='atendido'?'<button data-id="'.$buscar_hora.'" class="atendido btn btn-secondary btn-sm float-right">Atendido</button>':'<button class="reservar btn btn-secondary btn-sm float-right">Reservar</button>'; 
                    $boton=$buscar_hora>0 && $datos[$buscar_hora]->estado=='atendido'?" ":$boton; 
                @endphp                
                
                <p class="horas-g {{$clase}}">{{$h}} {{$apellido}} {{$nombre}} <span>@php echo $boton @endphp</span></p>
                

            @endfor
        </div>
        <div class="col-sm-6">
            <u><h3>Turno tarde</h3></u>
        </div>
    </div>    

<div></div>