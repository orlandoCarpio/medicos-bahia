$(document).ready(function(){
    App.FunctionsData.getSpecialty();
    App.FunctionsData.getSocialWork();
    App.FunctionsData.getTurnos();
    App.FunctionsData.getTurnosMedicos();
    $("#fech-bill").prop('placeholder','Fecha de nacimiento');
    $(".checkbox-container").on('click','.custom-control-input',App.FunctionEffects.showFormulario);
    $("#login-btn").on('click',App.FunctionEffects.showLoginModal);
    $(".navbar").on('click','#logout',App.FunctionsData.logout);
    $(".requerido").on('click',App.FunctionEffects.quitarMensajeError);
    $("#login-enter-btn").on('click',App.FunctionsData.searchUser);
    $("#bill-enter-bt").on('click',App.FunctionsData.saveUser);
    $(".container-login-name").hover(App.FunctionEffects.mostrarSubmenuLogin,App.FunctionEffects.ocultarSubmenuLogin);
    $("#formulario-busqueda").on('click','#busqueda-medico-btn',App.FunctionsData.getMedicos);
    $("#tabla-medicos").on('click','.detalles-medico',App.FunctionsData.getMedicosData);
    $("#horarios-cont-grid").on('change','#fecha-t',App.FunctionsData.getTurnos);
    $("#horario-grid").on('click','.cancelar-turno',App.FunctionsData.deleteTurnos);
    $("#horario-grid").on('click','.libre',App.FunctionsData.reserveTrun);
    

});