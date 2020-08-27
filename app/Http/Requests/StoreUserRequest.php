<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'required|max:50|regex:/^[a-zA-Z]+$/',
            'apellido'=>'required|max:50|regex:/^[a-zA-Z]+$/',
            'dni'=>'required|numeric|unique:App\Person,dni|between:999999,1000000000',
            'telefono'=>'required|numeric|between:9999,10000000000',
            'fecha_nac'=>'required|date',
            'domicilio'=>'required|regex:/^[a-zA-Z]+([,][a-zA-Z]+)+$/',
            'email'=>'required|email|unique:App\Login,email',
            'pass'=>'required|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,16}$/',
            'repass'=>'required|regex:/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{5,16}$/|same:pass'

        ];
    }
    public function messages(){
        return[
            'nombre.regex'=>'El nombre no debe tener caracteres especiales.',
            'nombre.required'=>'Debe ingresar un nombre.',
            'nombre.string'=>'EL nombre debe contener solo caracteres.',
            'apellido.required'=>'Debe ingresar un apellido.',
            'apellido.regex'=>'El apellido no debe tener caracteres especiales.',
            'apellido.string'=>'El apellido debe contener solo caracters.',
            'dni.required'=>'Debe ingresar un Dni.',
            'dni.numeric'=>'El Dni debe contener solo números.',
            'dni.unique'=>'El Dni ya existe.',
            'dni.between'=>'El Dni debe contener entre 7 y 9 digitos.',
            'telefono.required'=>'Debe ingresar un numero de teléfono.',
            'telefono.numeric'=>'El número de teléfono debe contener solo números.',
            'telefono.between'=>'El número de teléfono debe contener entre 5 y 12 números.',
            'fecha_nac.required'=>'Debe elegir una fecha de nacimiento.',
            'domicilio.required'=>'Debe ingresar un domicilio',
            'domicilio.regex'=>'Debe ingresar el barrio, calle, y numero separados por una coma.',
            'email.required'=>'Debe ingrear un correo.',
            'email.email'=>'El formato del correo no es correcto.',
            'email.unique'=>'El correo ya existe.',
            'pass.required'=>'Debe ingresar una contraseña.',
            'pass.regex'=>'La contraseña debe contener minusculas, mayusculas y números. Debe tener una longitud entre 5 y 16 caracteres.',
            'repass.required'=>'Debe ingresar una contraseña.',
            'repass.regex'=>'La contraseña debe contener minusculas, mayusculas y números. Debe tener una longitud entre 5 y 16 caracteres.',
            'repass.same'=>'Las contraseñas no coinciden',

        ];
    }
    
}
