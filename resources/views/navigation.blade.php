@php
$url=$_SERVER['REQUEST_URI'];
$base=basename($url);
@endphp
{{-- @if($base!='recover-pass') --}}
@if(!strpos($url, 'recover-pass') && !strpos($url, 'reset-pass'))
    <nav class="navbar navbar-dark bg-dark justify-content-end">
        <div class="container-login-name">
            <div class="div-login-name rounded"><i class="fa fa-user fa-3" aria-hidden="true"></i>Hola <span id="name-login"> </span><i class="fa fa-caret-down fa-3" aria-hidden="true"></i></div>
            <div class="submenu-login rounded-bottom"><a href="#" id="logout">Salir</a></div>
        </div>
        <div class="buttons-login">
            <a href="/create-account" id="crear-cuenta-btn" class="btn btn-primary " >Crear Cuenta</a>
            <button type="button"id="login-btn" class="btn btn-primary">Login</button>
        </div>
    </nav>
@endif