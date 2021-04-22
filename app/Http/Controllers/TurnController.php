<?php

namespace App\Http\Controllers;

use App\Specialty;
use App\Turn;
use App\Schedule;
use App\Login;
use App\User;
use App\Doctor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class TurnController extends Controller
{
    public function index($id){
        $datos = Specialty::select('people.id','people.apellido','people.nombre','doctors.id as iddoc','social_works.descripcion as des','specialties.descripcion','offices.id as ido','offices.calle','offices.numero','offices.barrio','offices.piso','offices.oficina')
        ->join('doctors','specialties.id','doctors.specialty_id')
        ->join('people','doctors.person_id','people.id')
        ->join('person_social_works','people.id','person_social_works.person_id')
        ->join('social_works','person_social_works.social_work_id','social_works.id')
        ->join('offices','doctors.office_id','offices.id')
        ->where('people.id','=',$id)
        ->get();
        $dato=$datos->unique('id'); 
        $obra_social = $datos->mapToGroups(function ($item, $key) { 
            return [$item['id'] => $item['des']];
        });  
        $obra_social=$obra_social->first();
        $horarios=Schedule::where('office_id','=',$dato[0]->ido)->get();
        $horarios = $horarios->sortBy('dia');
        return view('turns.turn',['datos'=>$dato,'horarios'=>$horarios  ,'obra_social'=>$obra_social->toArray()]);
    }
    //public function getSchedules($id,$fecha){
    public function getSchedules(Request $request,$id,$fecha,$dias){  
        if($id == "undefined" && $fecha == "undefined" && $dias == "undefined"){
            if($request->session()->get('tipo') == "medico" ){
                $id = $request->session()->get('id'); 
                $fecha = date('Y-m-d');
                $dia=Doctor::find($id)->office->schedules;
                $dias = $dia->map(function ($item, $key) {
                    return $item['dia'];
                });
            }
        }
        //return  ['id'=> $request->session()->get('id'),'fd' =>$request->session()->get('tipo')];       
        $dias_a=json_decode($dias);
        $turnos=Turn::where('doctor_id','=',$id)
                    ->where('fecha','=',$fecha) 
                    ->get();                    
        $d=date('w',strtotime($fecha));   
        //return $dias;        
        $schedule=Schedule::join('offices','schedules.office_id','offices.id')
                            ->where('schedules.dia','=',$d)
                            ->join('doctors','offices.id','doctors.office_id')
                            ->where('doctors.id','=',$id)
                            ->select('schedules.*')
                            ->get();
        //return $schedule;                    
        $turnos_s=$turnos->sortBy('hora');
        $turnos_g = $turnos_s->mapToGroups(function ($item, $key) {
            return [$item['fecha'] => $item['hora']];
        });        
        $turnos_g->toArray();                    
        $turnos_h = $turnos_g->get($fecha); 
        $id_p = $request->session()->get('id'); 
        $turnos_u=$turnos->where('user_id',$id_p)->all();
        $turno_u_e=Turn::where('user_id','=',$id_p)
                        ->where('doctor_id','=',$id)
                        ->get();
        //return [$id_p,$request->session()->get('id_l')];
        //return "entro aqui1";
        if($id_p!=""){
            $emails=($request->session()->get('tipo') == "medico" )?Doctor::findOrFail($id_p)->person->login_id: User::findOrFail($id_p)->person->login_id;
            $email=Login::findOrFail($emails)->email; 
            
        }else
            $email="";                
        
        $turno_u_e=$turno_u_e->all();                
        
        if(in_array($d,$dias_a)){
            //return "entro aqui";
            if($turnos->isNotEmpty()){    
               
                return view('turns.horarios-grilla',['id'=>$id,'horario'=>$schedule->toArray(),'turnos'=>$turnos,'horas'=>$turnos_h->toArray(),'hora_user'=>array_column($turnos_u, 'hora'),'fecha_user'=>array_column($turno_u_e, 'fecha'),'id_turno'=>array_column($turno_u_e, 'id'),'email'=>$email]);
            }else
                return view('turns.horarios-grilla',['id'=>$id,'horario'=>$schedule->toArray(),'fecha_user'=>array_column($turno_u_e, 'fecha'),'email'=>$email]);    
        }else{
            return '<p class="error-turno">No es posible reservar un turno en este día.<p>';
        }
    }
    public function deleteTurn($id){
        $delete=Turn::FindOrFail($id);
        $resultado=$delete->delete();
        if($resultado){
            $mensaje='<p class="error-log alert alert-danger">El turno se cancelo!!.<p>';  
            return response()->json(['estado'=>true,'mensaje'=>$mensaje]);
        }else
            return response()->json(['estado'=>false]);    
    }
    public function reserveTurn(Request $request){
        $id_p = $request->session()->get('id');
        
        if($id_p){            
            $datos = Doctor::find($request->input('idDoctor'))->office;
            $datos_p = Doctor::find($request->input('idDoctor'))->person; 
            $specialty = Doctor::find($request->input('idDoctor'))->specialty;
            $data = [
                'fullname'=>$datos_p->apellido.', '.$datos_p->nombre,
                'specialty' => $specialty->descripcion,                
                'piso'=>$datos->piso,
                'direccion'=>$datos->barrio.' '.$datos->calle.' '.$datos->numero,
                'oficina'=>$datos->oficina,
                'telefono'=>$datos->telefono,
            ];
            $datos=new Turn;
            $datos->fecha=$request->input('fecha');
            $datos->hora=$request->input('hora');
            $datos->user_id=$id_p;
            $datos->doctor_id=$request->input('idDoctor');
            $datos->tipo='atencion';
            $datos->estado='pendiente';
            $datos->save();
            $mensaje='<p class="exito-turno alert alert-success">Truno reservado con exito!.<p>';           
            $success = true;
        }else{
            $mensaje='<p class="error-log alert alert-danger">Debe iniciar session para reservar un turno.<p>';  
            $success =false;
            $data = array();
        }
        return response()->json(['iddoctor' => $request->input('idDoctor'),'fecha'=>$request->input('fecha'),'hora'=>$request->input('hora'),'mensaje'=>$mensaje,'success'=>$success,'datos'=>$data]);    

    }
    public function getTurnoMedico(Request $request, $fecha){
        $id=$request->session()->get('id');        
        $turnos=Turn::where('doctor_id','=',$id)
                    ->where('fecha','=',$fecha)
                    ->get();
        return $turnos;            
        if(count($turnos) > 0){            
            $estado=$turnos->sortBy('hora')->pluck('estado','user_id');
            $turnos=$turnos->sortBy('hora')->pluck('hora','user_id');
            $datos=$turnos->map(function($i,$k){
                return User::find($k)->person;
            });
        }
        $dia=date('w',strtotime($fecha));
        $horario=Doctor::find($id)->office->schedules->firstWhere('dia',$dia);
        //return $horario;
        return view('medico.listadoTurnos',['estado'=>$estado->toArray(),'datos'=>$datos,'turnos'=>$turnos->toArray(),'horario'=>$horario,'fecha'=>$fecha]);            
        //return response()->json(['estado'=>$estado->toArray(),'id'=>$id,'datos'=>$datos,'turnos'=>$turnos->toArray(),'horario'=>$horario,'fecha'=>$fecha]);            
    }
    public function updateTurn(Request $request,$id){
        $update=Turn::where('user_id',"=",$id)->update(['estado'=>'atendido']);
        return response()->json(['dato'=>$update]);
    }
    public function turnPdf(Request $request,$id,$fecha,$hora){
        $titulo = 'Styde.net';
        $datos = Doctor::find($id)->office;
        $datos_p = Doctor::find($id)->person; 
        $specialty = Doctor::find($id)->specialty;
        $pdf = PDF::loadView('turnopdf', compact(['titulo','id','fecha','hora','datos','datos_p','specialty']));
        return $pdf->stream('ejemplo.pdf');    
    }
}
