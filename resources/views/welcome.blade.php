@extends('layout.layout')

    @section('contenido')
    
    <div id="general-container">
        <div id="formulario-busqueda" class="container align-middle">
            <div class="col align-self-center">
                <div class="checkbox-container">
                    <div id="checkbox-center">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radio-name" name="opcionBusqueda" class="custom-control-input"value="name"checked>
                        <label class="custom-control-label" for="radio-name">Nombre o Apellido</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="radio-speciality" name="opcionBusqueda"value="speciality" class="custom-control-input">
                        <label class="custom-control-label" for="radio-speciality">Especialidad y Obra Social</label>
                    </div>
                    </div>
                </div>
                <div id="contenedor-formularios">
                    <div id="busqueda-nombre">
                        <div id="detail-speciality"class="alert alert-info" role="alert">
                            Puede realizar la búsqueda de un especialista mediante el Nombre o Apellido.
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control " name="name-search" id="name-search"placeholder="Ingrese un Nombre o Apellido">
                            </div>
                        </div>
                    </div>
                    <div id="busqueda-especialidad">
                        <div id="detail-speciality"class="alert alert-info" role="alert">
                            Puede puede realizar la búsqueda de un especialista mediante la obra social, especialidad o ambas.
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select class="custom-select" name="specialty-search" id="specialty-search">
                                    <option value="0">Elija un especialidad</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select class="custom-select" name="social-work-search" id="social-work-search">
                                    <option value="0">Elija una obra social</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="div-search-btn">
                        <button type="button" id="busqueda-medico-btn"class="btn btn-primary">Buscar</button>
                    </div>
                </div>

            </div>
        </div>
        
    </div>
    @endsection
    @section('table-medico')
        <a href="#tabla-medicos"id="ancla-medicos">medicos</a>
        
        <div id="tabla-medicos" class="container">
            

        </div>
        
    @include('modal')

    @endsection
    