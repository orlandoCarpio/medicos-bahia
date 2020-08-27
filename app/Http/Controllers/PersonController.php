<?php

namespace App\Http\Controllers;

use App\Person;
use App\Specialty;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Support\Facades\DB;
use Illuminate\View\View;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function searchName($name){
        $datos = Specialty::select('people.id','people.apellido','people.nombre','doctors.foto','social_works.descripcion as des','specialties.descripcion','offices.calle','offices.numero','offices.barrio','offices.piso','offices.oficina')
                    ->join('doctors','specialties.id','doctors.specialty_id')                
                    ->join('people','doctors.person_id','people.id')
                    ->join('person_social_works','people.id','person_social_works.person_id')
                    ->join('social_works','person_social_works.social_work_id','social_works.id') 
                    ->join('offices','doctors.office_id','offices.id')                   
                    ->where('people.nombre','like','%'.$name.'%')
                    ->where('people.tipo','=','medico')
                    ->orWhere('people.apellido','like','%'.$name.'%')
                    ->where('people.tipo','=','medico')
                    ->get();
        //$datos= DB::table('')           
        if(count($datos)!=0){
            $dat_array=$datos->unique('id');
            $obra_social = $datos->mapToGroups(function ($item, $key) {
                return [$item['id'] => $item['des']];
            }); 
            return response()->json(['estado'=>true,'datos'=>$dat_array,'obra_social'=>$obra_social]);
        }    
        return response()->json(['estado'=>false]);    
    }
    public function searchPerson($id){
        $datos = Specialty::select('people.id','people.apellido','people.nombre','doctors.foto','social_works.descripcion as des','specialties.descripcion','offices.id as ido','offices.calle','offices.numero','offices.barrio','offices.piso','offices.oficina')
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
            return view('template.datos-medico',['datos'=>$dato,'horarios'=>$horarios,'obra_social'=>$obra_social->toArray()]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
