<?php

namespace App\Http\Controllers;

use App\Specialty;
use App\Turn;
use App\Schedule;
use App\Login;
use App\User;
use App\Doctor;
use Illuminate\Http\Request;

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
        return view('turns.turn',['datos'=>$dato,'horarios'=>$horarios,'obra_social'=>$obra_social->toArray()]);
    }
    //public function getSchedules($id,$fecha){
    public function getSchedules(Request $request,$id,$fecha,$dias){ 
        $dias_a=json_decode($dias);
        $turnos=Turn::where('doctor_id','=',$id)
                    ->where('fecha','=',$fecha) 
                    ->get();            
        $d=date('w',strtotime($fecha));           
        $schedule=Schedule::join('offices','schedules.office_id','offices.id')
                            ->where('schedules.dia','=',$d)
                            ->join('doctors','offices.id','doctors.office_id')
                            ->where('doctors.id','=',$id)
                            ->select('schedules.*')
                            ->get();
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
        if($id_p!=""){
            $emails=User::findOrFail($id_p)->person->login_id;
            $email=Login::findOrFail($emails)->email; 
        }else
            $email="";                
        
        $turno_u_e=$turno_u_e->all();                
        if(in_array($d,$dias_a)){
            if($turnos->isNotEmpty()){    
               
                return view('turns.horarios-grilla',['id'=>$id,'horario'=>$schedule->toArray(),'turnos'=>$turnos,'horas'=>$turnos_h->toArray(),'hora_user'=>array_column($turnos_u, 'hora'),'fecha_user'=>array_column($turno_u_e, 'fecha'),'id_turno'=>array_column($turno_u_e, 'id'),'email'=>$email]);
            }else
                return view('turns.horarios-grilla',['id'=>$id,'horario'=>$schedule->toArray(),'fecha_user'=>array_column($turno_u_e, 'fecha')]);    
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
            
            $datos=new Turn;
            $datos->fecha=$request->input('fecha');
            $datos->hora=$request->input('hora');
            $datos->user_id=$id_p;
            $datos->doctor_id=$request->input('idDoctor');
            $datos->tipo='atencion';
            $datos->estado='pendiente';
            $datos->save();
            $mensaje='<p class="exito-turno alert alert-success">Truno reservado con exito!.<p>';           
        }else{
            $mensaje='<p class="error-log alert alert-danger">Debe iniciar session para reservar un turno.<p>';  
        }
        return response()->json(['fecha'=>$request->input('fecha'),'hora'=>$request->input('hora'),'mensaje'=>$mensaje]);    

    }
    public function getTurnoMedico(Request $request, $fecha){
        $id=$request->session()->get('id');
        $turnos=Turn::where('doctor_id','=',$id)
                    ->where('fecha','=',$fecha)
                    ->get();
        $turnos=$turnos->sortBy('hora')->pluck('hora','user_id');
        $datos=$turnos->map(function($i,$k){
            return User::find($k)->person;
        });
        $dia=date('w',strtotime($fecha));
        $horario=Doctor::find($id)->office->schedules->firstWhere('dia',$dia);
        return view('medico.listadoTurnos',['datos'=>$datos,'turnos'=>$turnos->toArray(),'horario'=>$horario,'fecha'=>$fecha]);            
    }
}
