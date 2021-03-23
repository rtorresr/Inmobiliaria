@extends('layouts.app')

@if ($transaccion == 1)
    @section('pageName', 'Registro de Ubigeo')
@else
    @section('pageName', 'Edición de Ubigeo')
@endif

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <form id="formRegistro" class="row">
                <input type="hidden" name="transaccion" id="transaccion" value="{{ $transaccion }}">
                <input type="hidden" name="id" id="id" value="{{ old('id',$model->id) }}">
                <input type="hidden" name="id_padre" id="id_padre" value="{{ old('id_padre',$model->id_padre) }}">
                @csrf
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ __('Datos') }}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @if ($model->id_padre != null)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="area">{{ __('Padre') }}</label>
                                            <input value="{{ old('padre',$model->padre->descripcion) }}" type="text" class="form-control" disabled>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="area">{{ __('Descripción') }}</label>
                                        <input value="{{ old('descripcion',$model->descripcion) }}" type="text" class="form-control" id="descripcion" name="descripcion">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="area">{{ __('Código') }}</label>
                                        <input value="{{ old('codigo',$model->codigo) }}" type="text" class="form-control" id="codigo" name="codigo">
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
        </div>
    </div>
</div>

@endsection


@section('script')

<script defer type="application/javascript">
    $(function() {

    });

    function validar(){
        if ($("#descripcion").val() == ""){
            $("#descripcion").addClass("is-invalid");
            notificar("warning","¡Falta indicar la descripción!");
            return false;
        }

        return true;
    }

    $("#btnGrabar").on("click",function(){
        removeValidation("#formRegistro");
        if (validar()){
            var formData = new FormData(document.querySelector("#formRegistro"));
            $.ajax({
                url: '{{ route('ubigeo.procesar') }}',
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
                setTimeout(function(){ window.location.replace("{{ route('ubigeo.index') }}"); }, 1000);
            })
            .fail(function(){
                notificar("danger","¡Error en la aplicación!");
            });
        }
    });
</script>

@endsection
