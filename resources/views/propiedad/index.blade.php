@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span>{{ __('Propiedades') }}</span>
                    <button id="agregarPropiedad" type="button" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Agregar Propiedad">Agregar</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tblPropiedad" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="10%">{{ __('Tipo') }}</th>
                                <th class="text-center" width="10%">{{ __('Modalidad') }}</th>
                                <th class="text-center" width="10%">{{ __('Precio') }}</th>
                                <th class="text-center" width="10%">{{ __('Habitaciones') }}</th>
                                <th class="text-center" width="30%">{{ __('Dirección') }}</th>
                                <th class="text-center" width="10%">{{ __('Área') }}</th>
                                <th class="text-center" width="10%">{{ __('Estado') }}</th>
                                <th class="text-center" width="10%">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<form class="d-none" action="{{ route('propiedad.formulario') }}" method="post" id="formPropiedad">
    @csrf
    <input type="hidden" name="transaccion" id="transaccion">
    <input type="hidden" name="id" id="id">
</form>

@endsection


@section('script')

<script>
    $(function() {
        tblPropiedad = $('#tblPropiedad').DataTable({
            processing: false,
            serverSide: true,
            pageLength: 10,
            searching: false,
            ordering: false,
            responsive: true,
            scrollX: true,
            dom: '<"header">tr<"footer"l<"paging-info"ip>>',
            language: {
                'url': '/resources/datatables-es_ES.json'
            },
            ajax: {
                url: '{{ route('propiedad.paginate') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: function(data){
                    // data.id = $("#id").val();
                }
            },
            columns: [
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return full.tipo.descripcion;
                    }
                },
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return full.tipo_venta.descripcion;
                    }
                },
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        var result = `S/.${full.precio_soles}`;
                        if (full.precio_dolares > 0){
                            result += ` / $${full.precio_dolares}`
                        }
                        return result;
                    }
                },
                { 'className': 'text-left',
                    'render': function (data, type, full, meta) {
                        var result = `<ul>`;
                        if (full.nro_habitaciones > 0){
                            result += `<li>${full.nro_habitaciones} habitaciones</li>`
                        }
                        if (full.nro_banos > 0){
                            result += `<li>${full.nro_banos} baños</li>`
                        }
                        result += `</ul>`;
                        return result;
                    }
                },
                { 'className': 'text-left',
                    'render': function (data, type, full, meta) {
                        var ubigeo = ``;
                        full.ubigeo.forEach(e => {
                            ubigeo += `${e.descripcion}, `
                        });
                        return `${full.direccion} / ${ubigeo.slice(0,-2)}`;
                    }
                },
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return `${full.area} m2`;
                    }
                },
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return full.tipo_estado.descripcion;
                    }
                },
                {
                    'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        return `<div>
                            <button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-sm btn-link text-success" name="Editar"><i class="fas fa-pencil-alt"></i></button>
                            <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-sm btn-link text-danger" name="Eliminar"><i class="fas fa-trash-alt"></i></button>
                        </div>`;
                    }
                }
            ]
        });

        $('#tblPropiedad tbody').on('click', 'button', function () {
            var action = $(this).attr('name');
            var data = tblPropiedad.row($(this).parents('tr')).data();

            switch(action){
                case 'Editar':
                    $('#transaccion').val(2);
                    $('#id').val(data.id);
                    $('#formPropiedad').submit();
                    break;
                case 'Eliminar':
                    var formData = new FormData();
                    formData.append('id',data.id);
                    formData.append('transaccion',3);
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
                    }).done(function(response){
                        notificar("success","¡Eliminado correctamente!");
                        tblPropiedad.ajax.reload();
                    }).fail(function(){
                        notificar("danger","¡Error en la aplicación!");
                    });
                    break;
            }

        });
    });

    $('#agregarPropiedad').on('click', function(e){
        $('#transaccion').val(1);
        $('#id').val(1)
        $('#formPropiedad').submit();
    });
</script>

@endsection
