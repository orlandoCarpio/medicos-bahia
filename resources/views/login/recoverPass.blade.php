@extends('layout.layout')
@section('contenido')
    <div id="cont-rec-pass" class="container">
        <h2>Recuperar contraseña</h2>
        <div class="cont-email">    
           <div class="cont-e"> 
                <div class="alert alert-info" role="alert">
                    Por favor, introduce tu dirección de correo electrónico. Recibirás un mensaje de correo electrónico con instrucciones sobre cómo restablecer tu contraseña.
                </div>                               
                @error('email')
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('email') }}
                    </div>                
                @enderror                
                <form method="POST" action="send-email">
                    @csrf
                    <div class="row form-group">
                        <div class="col-sm">
                            <label for="email-r">Correo electrónico</label>
                            <input type="email" id="email"name="email" placeholder="Ingrese su correo electrónico."class="form-control">        
                        </div>
                    </div>
                    <input type="submit" id="enviar-email"class="btn btn-primary" value='Enviar'>
                    <a href="#"class="c">Cambiar contraseña</a>
                </form>
            </div>
        </div>    
    </div>
    
@endsection