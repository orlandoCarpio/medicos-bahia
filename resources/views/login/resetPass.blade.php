@extends('layout.layout')
@section('contenido')
    <div id="cont-rec-pass" class="container">
        <h2>Nueva contraseña</h2>
        <div class="cont-email">    
           <div class="cont-e"> 
                <div class="alert alert-info" role="alert">
                    Por favor, introduce la nueva contraseña.
                </div>                                   
                <form method="POST" action={{url('send-pass')}}>
                    @csrf
                    <input type="hidden" value="{{$email}}" name="email">
                    <div class="row form-group">
                        <div class="col-sm">
                            <label for="pass-r">Contraseña</label>
                            <input type="password" id="pass-r"name="pass" placeholder="Ingrese su contraseña."class="form-control requerido">        
                            <div class="error-mensaje @error('pass') mostrar @enderror">
                                @error('pass')
                                    {{ $errors->first('pass') }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm">
                            <label for="pass-conf-r">Confirmar contraseña</label>
                            <input type="password" id="pass-conf-r"name="passConf" placeholder="Ingrese nuevamente su contraseña." class="form-control requerido">        
                            <div class="error-mensaje @error('passConf') mostrar @enderror">
                                @error('passConf')
                                    {{ $errors->first('passConf') }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <input type="submit" id="enviar-pass"class="btn btn-primary" value='Enviar'>
                </form>
            </div>
        </div>    
    </div>
    
@endsection