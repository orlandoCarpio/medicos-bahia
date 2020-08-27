<div class="container">
        <div class="card">
            <div class="img-class">
                 <img src="../image/medicof.jpg" alt=""> 
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$datos[0]->apellido}} {{$datos[0]->nombre}}</h5>
                <div class="row">
                    <div class="col col-sm">
                        <h4 class="card-title">Datos del médico</h4>
                        <p>Especialidad: {{$datos[0]->descripcion}}</p>
                        <p >Direccion: {{$datos[0]->calle}} {{$datos[0]->numero}}
                            @if(!empty($datos[0]->piso))
                                , Piso: {{$datos[0]->piso}}, Oficina: {{$datos[0]->oficina}}
                            @endif    
                        </p>
                        <p>Teléfono: 345234534</p>
                        <div class='os-class' ><div class='os-titulos col-4'>Obra Social: </div>
                            <div class="container-obras col-8">
                                @foreach ($obra_social as $c=>$os )
                                    @if($c==0)
                                        {{$os}} <img src="../icons/flecha-abajo.png">
                                        <div class="obras-option">
                                    @else    
                                        <p>{{$os}}</p>
                                    @endif    
                                @endforeach
                                </div>         
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm">
                        <h4 class="card-title">Horarios</h4>
                        @php
                            $dias=array(1=>'Lunes',2=>'Martes',3=>'Miércoles',4=>'Jueves',5=>'Viernes',6=>'Sábado');
                        @endphp
                        @foreach ( $horarios as $h )
                            <p >{{$dias[$h->dia]}}: {{date('H:i',strtotime($h->hora_entrada_M))}} a {{date('H:i',strtotime($h->hora_salida_M))}} 
                            @if($h->hora_entrada_T!='00:00:00')
                                y {{date('H:i',strtotime($h->hora_entrada_T))}} a {{date('H:i',strtotime($h->hora_salida_T))}}</p>    
                            @endif    
                        @endforeach
                       
                    </div>
                
            </div>
            <div class="row">
                    <div class="col col-sm">
                        <h4 class="card-title">Ubicacion</h4>
                    </div>
                </div>

        </div>
    </div>
    <div class="container btn-datos">
        <div class="row">
            <button id="salir-modal" class="btn btn-secondary" data-dismiss="modal">Salir</button>
            <a href="/solicitar-turno/{{$datos[0]->id}}"  class="btn btn-primary">Solicitar Turno</a>
        </div>
    </div>