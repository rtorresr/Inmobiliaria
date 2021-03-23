@extends('layouts.app')

@if ($transaccion == 1)
    @section('pageName', 'Registro de Propiedad')
@else
    @section('pageName', 'Edición de Propiedad')
@endif

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form id="formRegistro" class="row">
                <input type="hidden" name="transaccion" id="transaccion" value="{{ $transaccion }}">
                <input type="hidden" name="id" id="id" value="{{ old('id',$model->id) }}">
                <input type="hidden" name="id_agente" id="id_agente" value="{{ old('id_agente',$model->id_agente) }}">
                @csrf
                <div class="col-sm-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ __('Datos Generales') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_tipo">{{ __('Tipo') }}</label>
                                        <select class="custom-select" name="id_tipo" id="id_tipo">
                                            <option value="">Seleccione</option>
                                            @foreach ( App\Models\Tipo::tipos(Enum::getValue('tipo.propiedad')) as $tipo)
                                                <option value="{{ $tipo->id }}" @if ($tipo->id == old('id_tipo',$model->id_tipo)) selected @endif>{{ $tipo->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_estado">{{ __('Estado') }}</label>
                                        <select class="custom-select" name="id_estado" id="id_estado">
                                            <option value="">Seleccione</option>
                                            @foreach ( App\Models\Tipo::tipos(Enum::getValue('tipo.estado-propiedad')) as $tipo)
                                                <option value="{{ $tipo->id }}" @if ($tipo->id == old('id_estado',$model->id_estado)) selected @endif>{{ $tipo->descripcion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="area">{{ __('Área') }}</label>
                                        <input value="{{ old('area',$model->area) }}" type="text" class="form-control" id="area" name="area">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nro_habitaciones">{{ __('N° de Habitaciones') }}</label>
                                        <input value="{{ old('nro_habitaciones',$model->nro_habitaciones) }}" type="number" class="form-control" id="nro_habitaciones" name="nro_habitaciones" @error('nro_habitaciones') is-invalid @enderror value="{{ old('nro_habitaciones')}}">
                                        @error('nro_habitaciones')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nro_banos">{{ __('N° de Baños') }}</label>
                                        <input value="{{ old('nro_banos',$model->nro_banos) }}" type="number" class="form-control" id="nro_banos" name="nro_banos" @error('nro_banos') is-invalid @enderror value="{{ old('nro_banos')}}">
                                        @error('nro_banos')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descripcion">{{ __('Descripción') }}</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion',$model->descripcion) }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="file-container">
                                        <label for="image_principal" style="display: block!important">{{ __('Imagen Principal') }}</label>
                                        <div class="input-group mb-3">
                                            <img src="" width="60" height="60" class="rounded img-thumbnail mr-2 align-center" alt="Imagen" style="display: none;">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image_principal" id="image_principal" accept="image/x-png,image/gif,image/jpeg">
                                                <label class="custom-file-label" for="image_principal">Seleccione</label>
                                                <input type="hidden" name="image_path" id="image_path" value="{{ old('image_path',$model->image_path) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ __('Datos Venta') }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_venta">{{ __('Tipo de Venta') }}</label>
                                                <select class="custom-select" name="id_venta" id="id_venta">
                                                    <option value="">Seleccione</option>
                                                    @foreach ( App\Models\Tipo::tipos(Enum::getValue('tipo.venta')) as $tipo)
                                                        <option value="{{ $tipo->id }}" @if ($tipo->id == old('id_venta',$model->id_venta)) selected @endif>{{ $tipo->descripcion }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="precio_soles">{{ __('Precio en soles') }}</label>
                                                <input value="{{ old('precio_soles',$model->precio_soles) }}" type="text" class="form-control" id="precio_soles" name="precio_soles" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="precio_dolares">{{ __('Precio en dolares') }}</label>
                                                <input value="{{ old('precio_dolares',$model->precio_dolares) }}" type="text" class="form-control" id="precio_dolares" name="precio_dolares">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-header">
                                    {{ __('Datos Dirección') }}
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="ubigeo" value="{{ $model->ubigeo != null ? json_encode($model->ubigeo) : '' }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_departamento">{{ __('Departamento') }}</label>
                                                <select class="custom-select" name="id_departamento" id="id_departamento">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_provincia">{{ __('Provincia') }}</label>
                                                <select class="custom-select" name="id_provincia" id="id_provincia">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="id_distrito">{{ __('Distrito') }}</label>
                                                <select class="custom-select" name="id_distrito" id="id_distrito">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="direccion">{{ __('Dirección') }}</label>
                                                <textarea class="form-control" id="direccion" name="direccion" rows="2">{{ old('direccion',$model->direccion) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-primary" id="btnGrabar">{{ __('Grabar') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-3" style="display: none" id="propiedadFoto">
                        <div class="card-header">
                            <span>{{ __('Propiedad Fotos') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form class="col-sm-9" id="formRegistroPropiedadFot">
                                    <div class="file-container">
                                        <label for="image_propiedad_foto" style="display: block!important">{{ __('Imagen adicional') }}</label>
                                        <div class="input-group mb-3">
                                            <img src="" width="60" height="60" class="rounded img-thumbnail mr-2 align-center" alt="Imagen" style="display: none;">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image_propiedad_foto" id="image_propiedad_foto" accept="image/x-png,image/gif,image/jpeg">
                                                <label class="custom-file-label" for="image_propiedad_foto">Seleccione</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-sm-3">
                                    <div>&nbsp;</div>
                                    <button type="button" class="btn btn-primary" id="btnGrabarPropiedadImagen">{{ __('Grabar') }}</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tblPropiedadFoto">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center" width="80%">{{ __('Imagen') }}</th>
                                                <th class="text-center" width="20%">{{ __('Acciones') }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card mb-3" style="display: none" id="propiedadCaracteristica">
                        <div class="card-header">
                            <span>{{ __('Propiedad Características') }}</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form class="col-sm-9" id="formRegistroPropiedadCaracteristica">
                                    <div class="form-group">
                                        <label for="area">{{ __('Característica') }}</label>
                                        <input value="" type="text" class="form-control" id="caracteristica" name="caracteristica">
                                    </div>
                                </form>
                                <div class="col-sm-3">
                                    <div>&nbsp;</div>
                                    <button type="button" class="btn btn-primary" id="btnGrabarPropiedadCaracterística">{{ __('Grabar') }}</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered" id="tblPropiedadCaracteristica">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-left" width="90%">{{ __('Nombre') }}</th>
                                                <th class="text-center" width="10%">{{ __('Acciones') }}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')

<script defer type="application/javascript">
    $(function() {
        setUbigeo("#id_departamento",{{ Enum::getValue('ubigeo.departamento') }});

        if ($("#transaccion").val() == "2"){
            var datos = new Object();
            datos.image_path = $("#image_path").val();
            var model = new Object();
            model.id = "image_principal";
            model.ruta = "{{ route('propiedad.getImage') }}";
            model.token = "{{ Auth::user()->api_token}}";
            model.datos = datos;

            inputFileSet(model);

            $("#propiedadFoto").show();
            $("#propiedadCaracteristica").show();

            if ($("#ubigeo").val() != ''){
                var datos = JSON.parse($("#ubigeo").val());
                setUbigeo("#id_departamento",{{ Enum::getValue('ubigeo.departamento') }},datos[0].id);
                setUbigeo("#id_provincia",{{ Enum::getValue('ubigeo.provincia') }},datos[1].id,datos[0].id);
                setUbigeo("#id_distrito",{{ Enum::getValue('ubigeo.distrito') }},datos[2].id,datos[1].id);
            }
        }

        tblPropiedadFoto = $('#tblPropiedadFoto').DataTable({
            processing: false,
            serverSide: true,
            pageLength: 10,
            searching: false,
            ordering: false,
            responsive: true,
            dom: '<"header">tr<"footer"l<"paging-info"ip>>',
            language: {
                    'url': '/resources/datatables-es_ES.json'
            },
            ajax: {
                url: '{{ route('propiedadFoto.paginate') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: function(data){
                    data.id_propiedad = $("#id").val();
                }
            },
            columns: [
                {
                    'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return `<img src="/propiedadFoto/getImage/${full.id}" width="100" height="100" class="rounded img-thumbnail mr-2 align-center" alt="Imagen">`;
                    }
                },
                {
                    'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return `<div>
                            <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-sm btn-link text-danger" name="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        </div>`;
                    }
                }
            ]
        });

        $('#tblPropiedadFoto tbody').on('click', 'button', function () {
            var action = $(this).attr('name');
            var data = tblPropiedadFoto.row($(this).parents('tr')).data();

            switch(action){
                case 'Eliminar':
                    var formData = new FormData();
                    formData.append('id',data.id);
                    formData.append('transaccion',3);
                    $.ajax({
                        url: '{{ route('propiedadFoto.procesar') }}',
                        type: 'POST',
                        headers: {
                            Accept: 'application/json',
                            Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false
                    }).done(function(response){
                        notificar("success","¡Eliminado correctamente!");
                        tblPropiedadFoto.ajax.reload();
                    }).fail(function(){
                        notificar("danger","¡Error en la aplicación!");
                    });
                    break;
            }
        });

        tblPropiedadCaracteristica = $('#tblPropiedadCaracteristica').DataTable({
            processing: false,
            serverSide: true,
            pageLength: 10,
            searching: false,
            ordering: false,
            responsive: true,
            dom: '<"header">tr<"footer"l<"paging-info"ip>>',
            language: {
                    'url': '/resources/datatables-es_ES.json'
            },
            ajax: {
                url: '{{ route('propiedadCaracteristica.paginate') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: function(data){
                    data.id_propiedad = $("#id").val();
                }
            },
            columns: [
                { 'className': 'text-left', 'data': 'descripcion' },
                {
                    'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return `<div>
                            <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-sm btn-link text-danger" name="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        </div>`;
                    }
                }
            ]
        });

        $('#tblPropiedadCaracteristica tbody').on('click', 'button', function () {
            var action = $(this).attr('name');
            var data = tblPropiedadCaracteristica.row($(this).parents('tr')).data();

            switch(action){
                case 'Eliminar':
                    var formData = new FormData();
                    formData.append('id',data.id);
                    formData.append('transaccion',3);
                    $.ajax({
                        url: '{{ route('propiedadCaracteristica.procesar') }}',
                        type: 'POST',
                        headers: {
                            Accept: 'application/json',
                            Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                        },
                        data: formData,
                        processData: false,
                        contentType: false
                    }).done(function(response){
                        notificar("success","¡Eliminado correctamente!");
                        tblPropiedadCaracteristica.ajax.reload();
                    }).fail(function(){
                        notificar("danger","¡Error en la aplicación!");
                    });
                    break;
            }
        });
    });

    inputFileChange();

    function validar(){
        if ($("#id_tipo").val() == ""){
            $("#id_tipo").addClass("is-invalid");
            notificar("warning","¡Falta seleccionar el tipo de inmueble!");
            return false;
        }

        if ($("#id_venta").val() == ""){
            $("#id_venta").addClass("is-invalid");
            notificar("warning","¡Falta seleccionar el tipo de venta!");
            return false;
        }

        if ($("#id_estado").val() == ""){
            $("#id_estado").addClass("is-invalid");
            notificar("warning","¡Falta seleccionar el estado!");
            return false;
        }

        if ($("#precio_dolares").val() == ""){
            $("#precio_dolares").addClass("is-invalid");
            notificar("warning","¡Falta indicar el precio en dolares!");
            return false;
        }

        if ($("#area").val() == ""){
            $("#area").addClass("is-invalid");
            notificar("warning","¡Falta indicar el area del inmueble!");
            return false;
        }

        if ($("#nro_habitaciones").val() == ""){
            $("#nro_habitaciones").addClass("is-invalid");
            notificar("warning","¡Falta indicar el número de habitaciones");
            return false;
        }

        if ($("#nro_banos").val() == ""){
            $("#nro_banos").addClass("is-invalid");
            notificar("warning","¡Falta indicar el número de baños");
            return false;
        }

        if ($("#transaccion").val() == "1"){
            if ($("#image_principal").val() == ""){
                $("#image_principal").addClass("is-invalid");
                notificar("warning","¡Falta seleccionar la imagen principal");
                return false;
            }
        }

        return true;
    }

    $("#btnGrabar").on("click",function(){
        removeValidation("#formRegistro");
        if (validar()){
            var formData = new FormData(document.querySelector("#formRegistro"));
            $.ajax({
                url: '{{ route('propiedad.procesar') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: formData,
                processData: false,
                contentType: false
            }).done(function(){
                notificar("success","¡Grabado correctamente!");
                setTimeout(function(){ window.location.replace("{{ route('propiedad.index') }}"); }, 1000);
            })
            .fail(function(){
                notificar("danger","¡Error en la aplicación!");
            });
        }
    });

    var setUbigeo = function (selector, tipo, idDefault = 0, idPadre = null){
        listarUbigeo(
            "{{ Auth::user()->api_token}}",
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

    $("#btnGrabarPropiedadImagen").on("click",function(){
        removeValidation("#formRegistroPropiedadFot");
        if ($("#image_propiedad_foto").val() != ""){
            var formData = new FormData(document.querySelector("#formRegistroPropiedadFot"));
            formData.append('transaccion','1');
            formData.append('id_propiedad',$("#id").val());
            $.ajax({
                url: '{{ route('propiedadFoto.procesar') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: formData,
                processData: false,
                contentType: false
            }).done(function(){
                notificar("success","¡Grabado correctamente!");
                tblPropiedadFoto.ajax.reload();
            })
            .fail(function(){
                notificar("danger","¡Error en la aplicación!");
            });
        } else {
            $("#image_propiedad_foto").addClass("is-invalid");
            notificar("warning","¡No ha seleccionado la imagen a agregar");
        }
    });

    $("#btnGrabarPropiedadCaracterística").on("click",function(){
        removeValidation("#formRegistroPropiedadCaracteristica");
        if ($("#caracteristica").val() != ""){
            var formData = new FormData(document.querySelector("#formRegistroPropiedadCaracteristica"));
            formData.append('transaccion','1');
            formData.append('id_propiedad',$("#id").val());
            $.ajax({
                url: '{{ route('propiedadCaracteristica.procesar') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: formData,
                processData: false,
                contentType: false
            }).done(function(){
                $("#caracteristica").val('');
                notificar("success","¡Grabado correctamente!");
                tblPropiedadCaracteristica.ajax.reload();
            })
            .fail(function(){
                notificar("danger","¡Error en la aplicación!");
            });
        } else {
            $("#caracteristica").addClass("is-invalid");
            notificar("warning","¡No ha ingresado ninguna característica!");
        }
    });
</script>

@endsection
