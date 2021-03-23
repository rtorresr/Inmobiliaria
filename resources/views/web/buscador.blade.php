@extends('layouts.web')

@section('content')

    <section id="propiedad" class="w-100 mb-3">
        <div class="section-title">
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <span class="name">Buscador</span>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
        </div>
        <div class="section-body container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-4 col-lg-3">
                    <div class="buscador">
                        <div class="card px-4 py-3">
                            <form>
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_tipo">{{ __('Tipo Vivienda') }}</label>
                                            <select class="custom-select custom-select-sm" name="id_tipo" id="id_tipo">
                                                <option value="">Seleccione</option>
                                                @foreach ( App\Models\Tipo::tipos(Enum::getValue('tipo.propiedad')) as $tipo)
                                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_venta">{{ __('Tipo de Contrato') }}</label>
                                            <select class="custom-select custom-select-sm" name="id_venta" id="id_venta">
                                                <option value="">Seleccione</option>
                                                @foreach ( App\Models\Tipo::tipos(Enum::getValue('tipo.venta')) as $tipo)
                                                    <option value="{{ $tipo->id }}">{{ $tipo->descripcion }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nro_habitaciones">{{ __('N° de Habitaciones') }}</label>
                                            <input type="number" class="form-control form-control-sm" id="nro_habitaciones" name="nro_habitaciones">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="nro_banos">{{ __('N° de Baños') }}</label>
                                            <input type="number" class="form-control form-control-sm" id="nro_banos" name="nro_banos">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_departamento">{{ __('Departamento') }}</label>
                                            <select class="custom-select custom-select-sm" name="id_departamento" id="id_departamento">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_provincia">{{ __('Provincia') }}</label>
                                            <select class="custom-select custom-select-sm" name="id_provincia" id="id_provincia">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="id_distrito">{{ __('Distrito') }}</label>
                                            <select class="custom-select custom-select-sm" name="id_distrito" id="id_distrito">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <button id="buscar" class="btn btn-primary px-5 mt-3">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 col-md-8 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="resultado" class="row"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="paginador" style="display: none">
                                <nav>
                                    <ul class="pagination"></ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection

@section('script')

<script defer type="application/javascript">
    var longitudResultado = 4;
    $(function() {
        setUbigeo("#id_departamento",{{ Enum::getValue('ubigeo.departamento') }});
        $("#buscar").trigger("click");
    });

    var listarUbigeo = function(token, model, callback){
        var ruta = `/api/ubigeo/listar/${model.idTipo}`;
        if (model.idPadre != null){
            ruta += `/${model.idPadre}`;
        }
        $.ajax({
            url: ruta,
            type: 'GET',
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + token
            }
        }).done(callback);
    }

    var setUbigeo = function (selector, tipo, idDefault = 0, idPadre = null){
        listarUbigeo(
            '',
            {idTipo: tipo, idPadre: idPadre},
            function(response){
                $(selector).empty();
                $(selector).append(`<option value="">Seleccione</option>`);
                response.forEach(i => {
                    var selected = "";
                    if (i.id == idDefault){
                        selected = "selected"
                    }
                    $(selector).append(`<option value="${i.id}" ${selected}>${i.descripcion}</option>`);
                });
            }
        );
    }

    $("#id_departamento").on("change",function(){
        $("#id_provincia").empty().append(`<option value="">Seleccione</option>`);
        $("#id_distrito").empty().append(`<option value="">Seleccione</option>`);
        if ($("#id_departamento").val() != ""){
            setUbigeo("#id_provincia",{{ Enum::getValue('ubigeo.provincia') }},null,$("#id_departamento").val());
        }
    });

    $("#id_provincia").on("change",function(){
        $("#id_distrito").empty().append(`<option value="">Seleccione</option>`);
        if ($("#id_provincia").val() != ""){
            setUbigeo("#id_distrito",{{ Enum::getValue('ubigeo.distrito') }},null,$("#id_provincia").val());
        }
    });

    $("#buscar").on("click", function(e){
        e.preventDefault();
        e.stopPropagation();
        buscarResultados(0, longitudResultado);
    });

    buscarResultados = (start, length) => {
        var data = {
            start: start,
            length: length,
            id_tipo: $("#id_tipo").val(),
            id_venta: $("#id_venta").val(),
            nro_habitaciones: $("#nro_habitaciones").val(),
            nro_banos: $("#nro_banos").val(),
            id_departamento: $("#id_departamento").val(),
            id_provincia: $("#id_provincia").val(),
            id_distrito: $("#id_distrito").val()
        }
        $.post('{{ route('web.buscar') }}', data)
            .done(function(response){
                var data = response.original;
                mostrarResultado(data.data);
                generarPaginacion(data.recordsTotal, length, start);
            });
    }

    generarPaginacion = (total, length, start = 0) => {
        var paginas = Math.ceil(total/length);

        if (paginas > 0){
            $("#paginador").show();
        } else {
            $("#paginador").hide();
        }

        var html = `<li class="page-item navegacion ${ start == 0 ? "disabled" : "" }">
                        <a class="page-link" href="#" aria-label="Previous" data-page="-1">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>`;
        for (var i = 0; i < paginas; i++) {
            html += `<li class="page-item number ${ i == start ? "active" : "" }"><a class="page-link" href="#" data-page="${i}">${(i + 1)}</a></li>`;
        }

        html += `<li class="page-item navegacion ${ start == (paginas - 1) ? "disabled" : "" }">
                    <a class="page-link" aria-label="Next" href="#" data-page="+1">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>`;
        $("#paginador ul").empty();
        $("#paginador ul").html(html);
    }

    $("#paginador ul").on("click", "li.number a",function(e){
        e.preventDefault();
        e.stopPropagation();

        var page = $(this).attr("data-page");
        buscarResultados(page, longitudResultado);
    });

    $("#paginador ul").on("click", "li.navegacion a",function(e){
        e.preventDefault();
        e.stopPropagation();

        var incremento = $(this).attr("data-page");
        var paginaActual = $("#paginador ul li.number.active a").attr("data-page");
        var nuevaPagina = eval(paginaActual + incremento);
        buscarResultados(nuevaPagina, longitudResultado);
    });

    mostrarResultado = (data) => {
        $("#resultado").empty();
        data.forEach(function(item, i){
            var html = `<div class="col-lg-6">
                            <div class="card mb-3">
                                <img class="card-fluid" src="/propiedad/mostrarImagen/${item.id}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="text-primary text-left"><strong>${item.tipo.descripcion}</strong></h5>
                                            <h5 class="text-dark text-left"><strong>En ${item.tipo_venta.descripcion}</strong></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="text-right"><strong>S/. ${item.precio_soles}</strong></h5>
                                            <h6 class="text-muted text-right"><strong>$ ${item.precio_dolares}</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="px-3">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                            <span class="ml-2">${item.direccion}</span><br>
                                            <span class="ml-4">${item.ubigeo[0].descripcion}, ${item.ubigeo[1].descripcion}, ${item.ubigeo[2].descripcion}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 text-center">
                                        <p class="px-3">
                                            <i class="fas fa-bed text-primary"></i><span class="ml-2 font-weight-bolder"> ${item.nro_habitaciones}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <p class="px-3">
                                            <i class="fas fa-restroom text-primary"></i><span class="ml-2 font-weight-bolder">${item.nro_banos}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <a href="/web/verPropiedad/${item.id}/#propiedad" class="btn btn-primary mb-3">Más Información</a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            $("#resultado").append(html);
        });
    }
</script>

@endsection
