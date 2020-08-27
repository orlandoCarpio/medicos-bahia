
<form id="form-search-user" method="post"action="javascript:void(0)"> 
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="form-cont">
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="message-error-login"></div>
                <input type="text" class="form-control requerido " name="user-login" id="user-login"placeholder="Ingrese un correo.">
                <div class="error-mensaje"></div>
            </div>
        </div> 
        <div class="form-group row">
            <div class="col-sm-12">
                <input type="password" class="form-control requerido" name="password-login" id="password-login"placeholder="Ingrese una contraseña.">
                <div class="error-mensaje"></div>
                <p><a href="/recover-pass"> ¿Olvidaste tu contraseña?</a></p>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" id="login-enter-btn" class="btn btn-primary">Login</button>
            <input type="reset"id="reset-form-button" class="hidden-element">
        </div>
        <p>¿Todavía no tenes una cuenta? <a href="/create-account">Crear una cuenta</a></p>
    </div>    
</form>