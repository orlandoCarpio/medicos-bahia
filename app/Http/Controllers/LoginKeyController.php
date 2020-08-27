<?php

namespace App\Http\Controllers;

use App\LoginKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class LoginKeyController extends Controller
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
    public function store($email)
    {
        $clave=Crypt::encrypt($email);
        $dato=LoginKey::create([
            'email'=>$email,
            'clave'=>$clave,
        ]);
        $dato->save();
        return $clave;
        
    }
    public function delete($email){
        $delete=LoginKey::where('email','=',$email)->delete();
        return $delete;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoginKey  $loginKey
     * @return \Illuminate\Http\Response
     */
    public function show(LoginKey $loginKey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoginKey  $loginKey
     * @return \Illuminate\Http\Response
     */
    public function edit(LoginKey $loginKey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoginKey  $loginKey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoginKey $loginKey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoginKey  $loginKey
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoginKey $loginKey)
    {
        //
    }
}
