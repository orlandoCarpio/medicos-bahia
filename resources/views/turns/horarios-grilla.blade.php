@if(!empty($fecha_user) && $fecha_user[0]!="")
    <div class="alert alert-warning"><p>Usted tiene un turno con el medico el día {{date('d-m-Y',strtotime($fecha_user[0]))}}. Para solicitar otro turno debe cancelarlo.</p></div>
@endif

@php
$clase=(!empty($hora_user) && $hora_user[0]!="")?'libref':'libre';
@endphp
<input type="hidden"id="email-medico" value="{{$email}}">
@if(!empty($horario) && $horario[0]['hora_entrada_M']!="")
    <div class="col col-sm-6" id="turno1">
        <u><h3>Turno mañana</h3></u>
        @php
            $intervalo=30;
        @endphp    
        @for($i=strtotime($horario[0]['hora_entrada_M']);$i<=strtotime($horario[0]['hora_salida_M']);$i=strtotime('+30 minute',$i))
            @php
                $h=date('H:i:s',$i);
            @endphp
            @if(isset($horas))
                @if(in_array($h , $horas))    
                    <p class="horas-g ocupado" data-h="{{$h}}"> 
                        {{$h}} 
                        @if(!empty($hora_user) && $hora_user[0]==$h)
                            <span class="cancelar-turno" data-id="{{$id_turno[0]}}">Cancelar turno</span>
                        @endif                
                    </p>    
                @else    
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{date('H:i',strtotime($h))}}</p>
                @endif
            @else
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{date('H:i',strtotime($h))}}</p>
            @endif 
        @endfor 
    </div>
@endif
@if(!empty($horario) && $horario[0]['hora_entrada_T']!="")
    <div class="col col-sm-6" id="turno2">
        <u><h3>Turno tarde</h3></u>
        @php
            $intervalo=30;
        @endphp    
        @for($i=strtotime($horario[0]['hora_entrada_T']);$i<=strtotime($horario[0]['hora_salida_T']);$i=strtotime('+30 minute',$i))
            @php
                $h=date('H:i:s',$i);
            @endphp
            @if(isset($horas))
                @if(in_array($h , $horas))    
                    <p class="horas-g ocupado" data-h="{{$h}}"> 
                        {{$h}} 
                        @if(!empty($hora_user) && $hora_user[0]==$h)
                            <span class="cancelar-turno" data-id="{{$id_turno[0]}}">Cancelar turno</span>
                        @endif                
                    </p>    
                @else    
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{date('H:i',strtotime($h))}}</p>
                @endif
            @else
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{date('H:i',strtotime($h))}}</p>
            @endif
        @endfor 
    </div>
@endif
<div class="modal fade" id="modalPdfTourn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Turno médico</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><b>Médico: </b><span class="fullname"></span></p>
        <p><b>Especialista: </b><span class="specialty"></span></p>
        <p><b>Teléfono: </b><span class="phone"></span></p>
        <p><b>Fecha: </b><span class="date"></span></p>
        <p><b>Hora: </b><span class="hours"></span></p>
        <p><b>Dirección: </b><span class="address"></span></p>
        <p><b>Piso: </b><span class="floor"></span></p>
        <p><b>Oficina: </b><span class="office"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <a id="link-download-tourn" href="#"><button type="button" class="btn btn-primary" id="download-tourn">Descargar tuno en pdf</button></a>
      </div>
    </div>
  </div>
</div>