var App = App || {};
App.FunctionsData = {
    searchUser:function(){
        var token=$('#token').val();
        $(".message-error-login").empty();
        $(".message-error-login").removeClass('mostrar');
        jQuery.ajax({
            url: '/search-user',
            headers: {'X-CSRF-TOKEN': token},
            method: 'post',
            data:$('#form-search-user').serialize(),
            dataType:'json',
            success: function(response){
                if(response.respuesta){
                    if(response.tipo != 'paciente')
                        //console.log();
                        location.replace("http://127.0.0.1:8000/panel-medico/3");
                    $("#modalGlobal").modal('toggle');
                    $("#reset-form-button").click();
                    $("#name-login").append(response.datos[0].email);
                    $(".buttons-login").addClass('hidden-element');
                    $('.container-login-name').addClass('mostrar');
                    var pathname = window.location.pathname;
                    if(pathname.indexOf('solicitar-turno')!=-1)
                        App.FunctionsData.getTurnos();
                }else{
                    $(".message-error-login").append('El usuario o la contraseña es incorrecta.');
                    $(".message-error-login").addClass('mostrar');
                }

            },error : function(error) {
                if(error.status=422){
                    $(".requerido").each(function(indice){
                        var id=$(this).attr('id');
                        $(this).next().empty();
                        $(this).next().addClass('mostrar').append(error.responseJSON.errors[id][0]);
                    });
                    //$("#"+error.responseJSON.errors)
                }
            },
        });
    },
    logout:function(){
        $.get('/logout',function(data){
            $(".buttons-login").removeClass('hidden-element');
            $('.container-login-name').removeClass('mostrar');
            $('#name-login').empty();
            var pathname = window.location.pathname;
            if(pathname.indexOf('solicitar-turno')!=-1)
                App.FunctionsData.getTurnos();

            
        });
    },
    saveUser:function(){
        var token=$('input:hidden[name=_token]').val();
        $(".message-error-login").empty();
        $(".message-error-login").removeClass('mostrar');
        jQuery.ajax({
            url: '/search-user',
            headers: {'X-CSRF-TOKEN': token},
            method: 'post',
            data:$('#form-search-user').serialize(),
            dataType:'json',
            success: function(response){
                if(response.respuesta){
                    $("#modalGlobal").modal('toggle');
                    $("#reset-form-button").click();
                    $("#name-login").append(response.datos[0].email);
                    $(".buttons-login").addClass('hidden-element');
                    $('.container-login-name').addClass('mostrar');
                }else{
                    $(".message-error-login").append('El usuario o la contraseña es incorrecta.');
                    $(".message-error-login").addClass('mostrar');
                }

            },error : function(error) {
                if(error.status=422){
                    $(".requerido").each(function(indice){
                        var id=$(this).attr('id');
                        $(this).next().empty();
                        $(this).next().addClass('mostrar').append(error.responseJSON.errors[id][0]);
                    });
                    //$("#"+error.responseJSON.errors)
                }
            },
        });
    },
    getSpecialty:function(){
        $.get('get-specialty',function(data){
            console.log(data);
            $.each(data,function(i,e){
                $("#specialty-search").append('<option value="'+e.id+'">'+e.descripcion+'</option>');
            });
        });
    },
    getSocialWork:function(data){
        $.get('get-socialWork',function(data){
            console.log(data);
            $.each(data,function(i,e){
                $("#social-work-search").append('<option value="'+e.id+'">'+e.descripcion+'</option>');
            });
        });
    },    
    getMedicos:function(){
        var datos={};
        var opcion=$('input:radio[name=opcionBusqueda]:checked').val();
        if(opcion=='name'){
            var nameSearch=$('#name-search').val();
            url='search-name/'+nameSearch;
        }else{
            var socialWork=$('#social-work-search').val();
            var specialty=$('#specialty-search').val();
            url='search-obra-specialty/'+specialty+'/'+socialWork;
        }
        $.get(url,function(data){
            $("#tabla-medicos").empty();
            if(data.estado){
                $.each(data.datos,function(i,e){                    
                    $("#tabla-medicos").append(' <div class="row">'+
                        '<div class="col-sm foto-d"><div class="foto"><img src="../image/medicof.jpg" alt=""></div></div>'+
                        '<div class="col-sm"><p><span class="turno-title">Apellido y Nombre:</span> '+this.apellido+' '+this.nombre+'</p><p><span class="turno-title">Direccion:</span> '+this.calle+' '+this.numero+', piso: '+this.piso+' oficina: '+this.oficina+'</p><p><span class="turno-title">Teléfono:</span> 3434565</p></div>'+
                        '<div class="col-sm"><p><span class="turno-title">Especialidad:</span> '+this.descripcion+'</p><p><span class="turno-title">Obra Social:</span> <select class="form-control" id="f'+(i+1)+'" name="obra-social"></select></p></div>'+
                        '<div class="col-sm botones-m"><p><button class="btn btn-primary btn-lg detalles-medico" data-id="'+this.id+'">Mas Detalles</button></p>'+
                        '<p><a href="/solicitar-turno/'+this.id+'" class="btn btn-primary btn-lg">Solicitar Turno</a></p></div></div>'
                    );            
                    $.each(data.obra_social[this.id],function(ii,ee){
                        $("#f"+(i+1)).append('<option>'+ee+'</option>');        
                    });
                });
            }else{
                $("#tabla-medicos").append(' <div class="error-turno">No se encontraron resultados.</div>');
            }
            var d=document.getElementById('ancla-medicos');
            d.click();            
        });
    },
    getMedicosData:function(){
        var id=$(this).data('id');
       // jQuery.noConflict();
        $.get('datos-medicos/'+id,function(data){
            $("#title-modal").empty();
                $("#title-modal").append('Datos Personales');
                $("#login-div").css('display','none');
                $("#content-modal").find('.container').remove();
                $("#content-modal").append(data);
                $(".modal-dialog").addClass('modal-lg');
                jQuery.noConflict();
                $("#modalGlobal").modal('show');
            
        });
    },
    getTurnos:function(){
        var idM=$("#idMed").val();
        var dias=$("#dias").val();
        var fecha=$("#fecha-t").val();
        $.get('/turno-horarios/'+idM+'/'+fecha+'/'+dias,function(data){
            $("#horario-grid").empty();
            $("#horario-grid").append(data);
            if ( $(".libref" ).length ) {
                $("#name-login").empty();
                $("#name-login").append($("#email-medico").val());
                $(".buttons-login").addClass('hidden-element');
                $('.container-login-name').addClass('mostrar');
            }
        });
    },
    deleteTurnos:function(){
        var id=$(this).data('id');
        $.get('/borrar-turno/'+id,function(data){
            App.FunctionsData.getTurnos();
            $("#mensajesl").append(data.mensaje);
            setTimeout(function(){ $("#mensajesl").empty(); }, 3000);
        });
    },
    reserveTrun:function(){
        var datos={};
        datos.hora=$(this).data('h');
        datos.fecha=$('#fecha-me').val();
        datos.idDoctor=$('#idMed').val();
        $.ajax({
            url: '/reserve-turn',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: 'post',
            data:datos,
            dataType:'json',
            success: function(data){
                $("#mensajesl").append(data.mensaje);
                App.FunctionsData.getTurnos();
                setTimeout(function(){ $("#mensajesl").empty(); }, 3000);
                if(data.success){
                    $('#modalPdfTourn .fullname').append(data.datos.fullname);
                    $('#modalPdfTourn .specialty').append(data.datos.specialty);
                    $('#modalPdfTourn .phone').append(data.datos.telefono);
                    $('#modalPdfTourn .date').append(data.fecha);
                    $('#modalPdfTourn .hours').append(data.hora);
                    $('#modalPdfTourn .address').append(data.datos.direccion);
                    $('#modalPdfTourn .floor').append(data.datos.piso);
                    $('#modalPdfTourn .office').append(data.datos.oficina);
                    let boton = document.querySelector('#link-download-tourn');
                    boton.href = "/turnopdf/"+datos.idDoctor+"/"+datos.fecha+"/"+datos.hora;
                    // boton.dataset.id = data.iddoctor;
                    // boton.dataset.fecha = data.fecha;
                    // boton.dataset.hora = data.hora;
                    $('#modalPdfTourn').modal('show');
                    //window.location.href="/turnopdf/"+datos.idDoctor+"/"+datos.fecha+"/"+datos.hora;
                }    
            }
        });
    },
    downloadTurn: function(){
        let boton = document.querySelector('#download-tourn');
        window.location.href="/turnopdf/"+boton.dataset.id+"/"+boton.dataset.fecha+"/"+boton.dataset.hora;
    },
    getTurnosMedicos:function(){
        var fecha=$('#fecha-me').val();
        $.get('turnos-medico/'+fecha,function(data){
            $('#medico-contenedor').append(data);
        });
    },
    turnoAtendido:function(){
        var id=$(this).data('id');
        $.get('update-turn/'+id,function(d){
            //alert(d);
            App.FunctionsData.getTurnosMedicos();
        });
    }, 
    
    


    
}
