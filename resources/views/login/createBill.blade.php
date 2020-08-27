@extends('layout.layout')
@section('contenido')
<div id="main-container">
    <div id="container-create-bill">
    <div id="titulo-pagina"><h2>Registro de usuarios</h2></div>
    <form method="POST" action="/save-bill">
    @csrf
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="lastname-bill">Apellido</label>
                <input type="text" class="form-control requerido" name="apellido" id="lastname-bill"placeholder="Ingrese su apelldio."value="{{@old('apellido')}}">
                <div class="error-mensaje @error('apellido') mostrar @enderror">
                    @error('apellido')
                        {{ $errors->first('apellido') }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="name-bill">Nombre</label>
                <input type="text" class="form-control requerido" name="nombre" id="name-bill"placeholder="Ingrese su nombre."value="{{@old('nombre')}}">
                <div class="error-mensaje @error('nombre') mostrar @enderror">
                    @error('nombre')
                        {{ $errors->first('nombre') }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="dni-bill">DNI</label>
                <input type="number" class="form-control requerido " name="dni" id="dni-bill"placeholder="Ingrese su DNI."value="{{@old('dni')}}">
                <div class="error-mensaje @error('dni') mostrar @enderror">
                    @error('dni')
                        {{ $errors->first('dni') }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="medico-l">¿Es usted médico?</label>
                <div id="medico-l">
                    <label class="switch">
                        <input type="checkbox" name="medico" id="medico" class="form-control checkbox-c">
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            <label for="tel-bill">Teléfono</label>
                <input type="number" class="form-control requerido " name="telefono" id="tel-bill"placeholder="Ingrese su teléfono."value="{{@old('telefono')}}">
                <div class="error-mensaje @error('telefono') mostrar @enderror">
                    @error('telefono')
                        {{ $errors->first('telefono') }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="fech-bill">Fecha de nacimiento</label>
                <input type="date" class="form-control requerido " name="fecha_nac" id="fech-bill"value="{{@old('fecha_nac')}}">
                <div class="error-mensaje @if ($errors->has('fecha_nac')) mostrar @endif">
                    @if ($errors->has('fecha_nac'))
                        {{ $errors->first('fecha_nac') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="dom-bill">Domicilio</label>
                <input type="text" class="form-control requerido " name="domicilio" id="dom-bill"placeholder="Ingrese el barrio,calle,numero."value="{{@old('domicilio')}}">
                <div class="error-mensaje @if ($errors->has('domicilio')) mostrar @endif">
                    @if ($errors->has('domicilio'))
                        {{ $errors->first('domicilio') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="email-bill">Email</label>
                <input type="email" class="form-control requerido" name="email" id="email-bill"placeholder="Ingrese un correo."value="{{@old('email')}}">
                <div class="error-mensaje @if ($errors->has('email')) mostrar @endif">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="pass-bill">Contraseña</label>
                <input type="password" class="form-control requerido" name="pass" id="pass-bill"placeholder="Ingrese una contraseña.">
                <div class="error-mensaje @if ($errors->has('pass')) mostrar @endif">
                    @if ($errors->has('pass'))
                        {{ $errors->first('pass') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <label for="repass-bill">Repita la contraseña</label>
                <input type="password" class="form-control requerido" name="repass" id="repass-bill"placeholder="Ingrese nuevamente la contraseña.">
                <div class="error-mensaje @if ($errors->has('repass')) mostrar @endif">
                    @if ($errors->has('repass'))
                        {{ $errors->first('repass') }}
                    @endif
                </div>
            </div>
        </div>        
        <div class="modal-footer">
            <button type="submit" id="bill-enter-btn" class="btn btn-primary">Guardar</button>
            <a href="/" type="button" id="cancel-btn" class="btn btn-secondary">Salir</a>
        </div>
        </form>
        <div  class="alert alert-info info-mail" role="alert">Le enviaremos un mensaje a su correo electronico para verificar que le pertenece.</div>    
    </div>    
    
</div>        
@endsection