<?php

namespace App\Http\Controllers;

use App\SocialWork;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class SocialWorkController extends Controller
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
    public function getSocialWork(){
       // $consulta=DB::table('specialties')->join('doctors','specialties.id','=','doctors.specialty_id')->join('people','doctors.person_id','=','people.id')->join('person_social_works','people.id','=','person_social_works.person_id')->join('social_works','person_social_works.social_work_id','=','social_works.id')->where('precialties.id','=',2)->select('social_works.id','social_works.descripcion')->get();
       $consulta=SocialWork::select('id','descripcion')
                            ->orderBy('descripcion')
                            ->get();
        return response()->json($consulta);                            
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
     * @param  \App\SocialWork  $socialWork
     * @return \Illuminate\Http\Response
     */
    public function show(SocialWork $socialWork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialWork  $socialWork
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialWork $socialWork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialWork  $socialWork
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialWork $socialWork)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialWork  $socialWork
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialWork $socialWork)
    {
        //
    }
}
