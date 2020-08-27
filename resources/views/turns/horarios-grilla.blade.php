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
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{$h}}</p>
                @endif
            @else
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{$h}}</p>
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
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{$h}}</p>
                @endif
            @else
                    <p class="horas-g {{$clase}}" data-h="{{$h}}">{{$h}}</p>
            @endif
        @endfor 
    </div>
@endif