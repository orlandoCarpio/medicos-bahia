<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//login
Route::post("/search-user","LoginController@searchUser");
Route::view('/create-account','login.createBill');
Route::get('/logout','LoginController@logout');
Route::view('/recover-pass','login.recoverPass');
Route::post('/send-email','LoginController@sendEmail');
Route::post('/send-pass','LoginController@sendPass');
Route::get('/reset-pass/{clave}','LoginController@resetPass');
Route::get('/verify-user/{clave}','LoginController@verifyUser');

Route::post("/save-bill","LoginController@store");
//busqueda medico
Route::get('search-name/{name}','PersonController@searchName');
Route::get('search-obra-specialty/{specialty}/{socialWork}','SpecialtyController@searchMedico');
Route::get('datos-medicos/{id}','PersonController@searchPerson');
Route::get('detalle',function(){
    return view('template.datos-medico');
});
//Especialidades
Route::get('get-specialty','SpecialtyController@getSpecialty');
//Obra social
Route::get('get-socialWork','SocialWorkController@getSocialWork');
//turno
Route::get('/solicitar-turno/{id}','TurnController@index');
Route::get('/turno-horarios/{id}/{fecha}/{dias}','TurnController@getSchedules');
Route::get('/borrar-turno/{id}','TurnController@deleteTurn');
Route::post('/reserve-turn','TurnController@reserveTurn');
Route::get('/update-turn/{id}','TurnController@updateTurn');
//medico 
//Route::view('/panel-medico','panelMedico');
Route::get('/panel-medico/{id}', function($id){

    return view('panelMedico',['id' => $id]);
});
Route::get('/turnos-medico/{fecha}','TurnController@getTurnoMedico');
Route::get('/turnopdf/{id}/{fecha}/{hora}', 'TurnController@turnPdf');
// Route::get('/turnopdf', function () {
//     $pdf = PDF::loadView('turnopdf');
//   return $pdf->download('pruebapdf.pdf');
//     //return view('turnopdf');
// });