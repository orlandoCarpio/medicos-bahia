<?php

namespace App\Http\Controllers;

use App\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialtyController extends Controller
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
    public function getSpecialty(){
        $consulta=Specialty::select('id','descripcion')->orderBy('descripcion')->get();
        return response()->json($consulta);
    }
    public function searchMedico($idS,$idSW){
        if($idS!=0 && $idSW!=0){
                $datos=Specialty::select('people.id','people.apellido','people.nombre','doctors.foto','social_works.descripcion as des','specialties.descripcion','offices.calle','offices.numero','offices.barrio','offices.piso','offices.oficina')
                        ->join('doctors','specialties.id','doctors.specialty_id')                
                        ->join('people','doctors.person_id','people.id')
                        ->join('person_social_works','people.id','person_social_works.person_id')
                        ->join('social_works','person_social_works.social_work_id','social_works.id')
                        ->join('offices','doctors.office_id','offices.id')
                        ->where('specialties.id','=',$idS)
                        ->where('social_works.id','=',$idSW)
                        ->get();

                        if(count($datos)!=0){
                            $dat_array=$datos->unique('id');
                            $obra_social = $datos->mapToGroups(function ($item, $key) {
                                return [$item['id'] => $item['des']];
                            }); 
                            return response()->json(['estado'=>true,'datos'=>$dat_array,'obra_social'=>$obra_social]);
                        }
        }elseif ($idS!=0 && $idSW==0) {
                $datos=Specialty::select('people.id','people.apellido','people.nombre','doctors.foto','social_works.descripcion as des','specialties.descripcion','offices.calle','offices.numero','offices.barrio','offices.piso','offices.oficina')
                        ->join('doctors','specialties.id','doctors.specialty_id')                
                        ->join('people','doctors.person_id','people.id')
                        ->join('person_social_works','people.id','person_social_works.person_id')
                        ->join('social_works','person_social_works.social_work_id','social_works.id')
                        ->join('offices','doctors.office_id','offices.id')
                        ->where('specialties.id','=',$idS)
                        ->get();                
                
                if(count($datos)!=0){
                    $dat_array=$datos->unique('id');
                    $obra_social = $datos->mapToGroups(function ($item, $key) {
                        return [$item['id'] => $item['des']];
                    }); 
                    return response()->json(['estado'=>true,'datos'=>$dat_array,'obra_social'=>$obra_social]);
                }
        }                
        if(count($datos)!=0){
            return response()->json(['estado'=>true,'datos'=>$datos]);
        }else{
            return response()->json(['estado'=>false]);
        }
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
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialty $specialty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Specialty  $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        //
    }
}
