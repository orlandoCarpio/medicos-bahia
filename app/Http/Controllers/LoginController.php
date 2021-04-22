<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Login;
use App\Person;
use App\Mail\CorreoPass;
use App\Mail\VerifyAccount;
use App\Http\Controllers\LoginKeyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;



class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request){
        $user=$request->input('user-login');
        $pass=$request->input('password-login');
        $request->validate([
                'user-login'=>'required|email',// |exists:login,email',
                'password-login'=>'required',
        ],[
            'user-login.required'=>'Ingrese un correo.',
            'user-login.email'=>'El formato del correo es incorrecto.',
            'password-login.required'=>'Ingrese un contraseña.',
        ]);
        $consulta=Login::where('email','=',$user)->where('pass','=',$pass)->get();
        
        if(count($consulta)!=0){
            $tipo=$consulta[0]->person->tipo;
            $id=$tipo=='medico'?$consulta[0]->person->doctor->id:$consulta[0]->person->user->id;
                //$users=$consulta[0]->person->user;
            if (!$request->session()->has('id')) {
                $request->session()->put('id',$id );                
                $request->session()->put('tipo',$tipo );                
            }
            return json_encode(['respuesta'=>true,'datos'=>$consulta,'tipo'=>$tipo]);    
        }else
            return json_encode(['respuesta'=>false,'datos'=>$consulta]);    
        //return json_encode(['user'=>$request->input('user-login'),'pass'=>$request->input('password-login')]);
    }
    public function logout(Request $request){
        $request->session()->forget('id');
        return response()->json(['dato'=>$request]);
    }
    public function sendEmail(Request $request){
        $request->validate([
            'email'=>'required|email|exists:logins,email',
        ],[
            'email.required'=>"Debe ingresar un correo electrónico.",
            'email.email'=>'El formato del correo no es correcto.',
            'email.exists'=>'El correo electrónico no existe.',
        ]);
        $login_k=new LoginKeyController;
        $login_k->delete($request->input('email'));
        $login_k=$login_k->store($request->input('email'));
        Mail::to('dfsdf@hotmail.com')->send(new CorreoPass($request->input('email'),$login_k));
        //echo $login_k;    
        
    }
    public function resetPass($clave){
        $email=Crypt::decrypt($clave);
        return view('login.resetPass',['email'=>$email]);
    }
    public function verifyUser($clave){        
        $login_k=new LoginKeyController;
        $email=Crypt::decrypt($clave);
        //Login::where('email','=',$email)->update(['verificar'=>true]);
        $login_k->delete($email);
        return redirect('/');
    }
    public function sendPass(Request $req){
        $req->validate([
            'pass'=>'required|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,16}$/',
            'passConf'=>'required|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,16}$/|same:pass',
        ],[
            'pass.required'=>'Ingrese alguna conntraseña.',
            'pass.regex'=>'¡Format incorrecto!, la contraseña debe tener mayúsculas, minúsculas y números. Debe tener una longitud entre 5 y 16 caracteres.',
            'passConf.required'=>'Ingrese alguna conntraseña.',
            'passConf.regex'=>'¡Format incorrecto!, la contraseña debe tener mayúsculas, minúsculas y números. Debe tener una longitud entre 5 y 16 caracteres.',
            'passConf.same'=>'Las contaseñas no coinciden.',
        ]);
        Login::where('email','=',$req->input('email'))->update(['pass'=>$req->input('pass')]);
        $login_k=new LoginKeyController;
        $login_k->delete($req->input('email'));
        return redirect('/');
        //print_r($req->input());
    }
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
    //public function store(StoreUserRequest $request)
    public function store(Request $request)
    {
        
        DB::transaction(function() use ($request){
            $tipo= array_key_exists('medico',$request->input())?"medico":"paciente";   
            $login=Login::create([
                'pass'=>$request->input('pass'),
                'email'=>$request->input('email')
                ]);
            $person=Person::create([
                'nombre'=>$request->input('nombre'),
                'apellido'=>$request->input('apellido'),
                'dni'=>$request->input('dni'),
                'tipo'=>$tipo,
                'fecha_nac'=>$request->input('fecha_nac'),
                'telefono'=>$request->input('telefono'),
                'domicilio'=>$request->input('domicilio'),
                'login_id'=>$login->id
            ]);
            $login->save();
            $person->save();
            $login_k=new LoginKeyController;
            $login_k=$login_k->store($request->input('email'));
            Mail::to($request->input('email'))->send(new VerifyAccount($request->input('email'),$login_k));
        });
        
        
        
        //return redirect('/');
        return redirect('/')->with('dato','llego bien');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(Login $login)
    {
        //
    }
}
