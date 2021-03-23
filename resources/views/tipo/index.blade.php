@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Mantenimiento de tipos') }}
                    <button id="agregarTipo" type="button" class="btn btn-sm btn-primary float-right" data-toggle="tooltip" data-placement="top" title="Agregar Tipo">Agregar</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="tblTipo">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" width="80%">{{ __('Nombre') }}</th>
                                <th class="text-center" width="20%">{{ __('Acciones') }}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
              </div>
        </div>
    </div>
</div>

<form class="d-none" action="{{ route('tipo.formulario') }}" method="post" id="formTipo">
    @csrf
    <input type="hidden" name="transaccion" id="transaccion">
    <input type="hidden" name="id" id="id">
    <input type="hidden" name="id_padre" id="id_padre" value="{{ $model->id }}">
</form>

@endsection


@section('script')

<script defer>
    $(function() {
        tblTipo = $('#tblTipo').DataTable({
            processing: false,
            serverSide: true,
            pageLength: 10,
            searching: false,
            ordering: false,
            responsive: true,
            dom: '<"header">tr<"footer"l<"paging-info"ip>>',
            language: {
                    'url': '/js/datatables-es_ES.json'
            },
            ajax: {
                url: '{{ route('tipo.paginate') }}',
                type: 'POST',
                headers: {
                    Accept: 'application/json',
                    Authorization: 'Bearer ' + '{{ Auth::user()->api_token}}'
                },
                data: function(data){
                    data.id = $("#id_padre").val();
                }
            },
            columns: [
                { 'data': 'descripcion', 'className': 'text-center' },
                { 'className': 'text-center',
                    'render': function (data, type, full, meta) {
                        var html = ``;
                        html += `<button data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-sm btn-link text-secondary" name="Ver"><i class="fas fa-plus"></i></button>`;

                        html += `<button data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-sm btn-link text-success" name="Editar"><i class="fas fa-pencil-alt"></i></button>
                            <button data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-sm btn-link text-danger" name="Eliminar"><i class="fas fa-trash-alt"></i></button>`;
                        return `<div>${html}</div>`;
                    }
                }
            ]
        });

        $('#tblTipo tbody').on('click', 'button', function () {
            var action = $(this).attr('name');
            var data = tblTipo.row($(this).parents('tr')).data();

            switch(action){
                case 'Ver':
                    window.location = "/tipo/" + data.id
                    break;
                case 'Editar':
                    $('#transaccion').val(2);
                    $('#id').val(data.id);
                    $('#formTipo').submit();
                    break;
                case 'Eliminar':
                    var formData = new FormData();
                    formData.append('id',data.id);
                    formData.append('transaccion',3);
                    $.ajax({
                        url: '{{ route('tipo.procesar') }}',
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
                        tblTipo.ajax.reload();
                    }).fail(function(){
                        notificar("danger","¡Error en la aplicación!");
                    });
                    break;
            }
        });
    });

    $('#agregarTipo').on('click', function(e){
        $('#transaccion').val(1);
        $('#formTipo').submit();
    });
</script>

@endsection
