var App = App || {};
App.FunctionEffects = {
    showFormulario:function(){
        if($(this).val()=="name"){
            $("#busqueda-especialidad").css('display','none');
            $("#busqueda-nombre").css('display','block');
        }else{
            $("#busqueda-nombre").css('display','none');
            $("#busqueda-especialidad").css('display','block');
        }
    },
    showLoginModal:function(){
        $("#content-modal").find('.container').remove();
        //jQuery.noConflict();
        $("#modalGlobal").modal('toggle');
        $("#title-modal").text('Login');
        console.log($("#title-modal"));
        $("#login-div").css('display','block');
        $("#create-new-bill-div").css('display','none');
    },
    quitarMensajeError:function(){
        if($(this).next().hasClass('error-mensaje'))
        $(this).next().removeClass('mostrar');
        $(this).next().empty();
        $(".message-error-login").empty();
        $(".message-error-login").removeClass('mostrar');
    },
    mostrarSubmenuLogin:function(){
        jQuery(".submenu-login").slideDown(300);
        $(".div-login-name").removeClass('rounded')
        $(".div-login-name").addClass('rounded-top');
        
    },
    ocultarSubmenuLogin:function(){
        jQuery(".submenu-login").slideUp(300);
        $(".div-login-name").addClass('rounded')
        $(".div-login-name").removeClass('rounded-top');
        
    },
    
   
    
    
   

}