<h2 class="text-center">Turno médico</h2>
<hr>
<p><b>Médico: </b>{{$datos_p->apellido}},  {{$datos_p->nombre}}</p>
<p><b>Especialista: </b>{{$specialty->descripcion}}</p>
<p><b>Teléfono: </b>{{$datos->telefono}}</p>
<p><b>Fecha: </b>{{date('d-m-Y',strtotime($fecha))}}</p>
<p><b>Hora: </b>{{date('H:i',strtotime($hora))}}</p>
<p><b>Dirección: </b>{{$datos->barrio}}, {{$datos->calle}}, {{$datos->numero}}</p>
<p><b>Piso: </b>{{$datos->piso}}</p>
<p><b>Oficina: </b>{{$datos->oficina}}</p>
