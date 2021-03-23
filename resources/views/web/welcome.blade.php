@extends('layouts.web')

@section('content')
    <section id="inicio" class="w-100 mb-3 first">
        <div id="carouselPrincipal" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($model->carouselPrincipal->getData()->data as $i => $item)
                    <li data-target="#carouselPrincipal" data-slide-to="{{ $i }}" class="{{ $i == 0 ? "active" : "" }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($model->carouselPrincipal->getData()->data as $i => $item)
                    <div class="carousel-item {{ $i == 0 ? "active" : "" }}">
                        <img class="d-block" src="/propiedad/mostrarImagen/{{ $item->id }}" alt="Imagen">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselPrincipal" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselPrincipal   " role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section id="nosotros" class="w-100 mb-5">
        <div class="section-title">
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <span class="name">Nosotros</span>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
        </div>

        <div class="section-body container">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <div class="card px-3 pt-3 ">
                        <div class="section-article">
                            <h4>Quienes Somos</h4>
                            <p>NICS  Inmobiliaria es uno de los servicios que brinda NICS EJECUTORES E.I.R.L. dedicada a la construcción de bienes inmuebles y al servicio integral de bienes raíces, que permitan mejorar la calidad de vida de los ciudadanos. Contamos con registro  PJ-1184 del Ministerio de Vivienda Construcción y Saneamiento.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="card px-3 pt-3 ">
                        <div class="section-article text-right">
                            <h4>Visión</h4>
                            <p>Tener una prestigiosa Empresa Inmobiliaria, que se caracterice por brindar un servicio integral y personalizado, basado en la ética y eficiencia.  Desde el inicio hasta la culminación de las distintas operaciones que realicemos. Logrando como resultado, seguridad, confianza y entera satisfacción de nuestros clientes.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card px-3 pt-3 ">
                        <div class="section-article text-right">
                            <h4>Misión</h4>
                            <p>Somos una empresa familiar que brinda servicios integrales y personalizados, basado en la ética y eficiencia. Para lo cual asociamos a personas con ética, que busquen el éxito y tengan vocación de servicio. Capacitándonos y actualizándonos permanentemente, logrando una mejora continua en nuestros niveles de servicio, que se vea reflejada en la satisfacción de nuestros clientes.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="card px-3 pt-3 ">
                        <div class="section-article">
                            <h4>Agentes Inmobiliarios</h4>
                            <p>
                                <ul>
                                    <li>Ivonne Ruth Gilvonio Cano MVCyS PN-7862</li>
                                    <li>Fischer Roger Felices Arana MVCyS PN-7861</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card px-3 pt-3 ">
                        <div class="section-article">
                            <h4>Asesores Inmobiliarios</h4>
                            <p>
                                <ol>
                                    <li>Ing. Christian Felices Gilvonio</li>
                                    <li>B/Arq. Stefany Felices Gilvonio</li>
                                </ol>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="propiedades" class="w-100 mb-3">
        <div class="section-title">
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <span class="name">Nuestras Propiedades</span>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
        </div>

        <div class="carousel carousel-multiple slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">
                @foreach($model->carouselPrincipal->getData()->data as $i => $item)
                    <div class="carousel-item {{ $i == 0 ? "active" : "" }}">
                        <div class="col-md-4">
                            <div class="card">
                                <img class="card-fluid " src="/propiedad/mostrarImagen/{{ $item->id }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5 class="text-primary text-left"><strong>{{ $item->tipo->descripcion }}</strong></h5>
                                            <h5 class="text-dark text-left"><strong>En {{ $item->tipo_venta->descripcion }}</strong></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5 class="text-right"><strong>S/. {{ $item->precio_soles }}</strong></h5>
                                            <h6 class="text-muted text-right"><strong>$ {{ $item->precio_dolares }}</strong></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p class="px-3">
                                            <i class="fas fa-map-marker-alt text-primary"></i>
                                            <span class="ml-2">{{ $item->direccion }}</span><br>
                                            <span class="ml-4">{{ $item->ubigeo[0]->descripcion }}, {{ $item->ubigeo[1]->descripcion }}, {{ $item->ubigeo[2]->descripcion }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 text-center">
                                        <p class="px-3">
                                            <i class="fas fa-bed text-primary"></i><span class="ml-2 font-weight-bolder"> {{ $item->nro_habitaciones }}</span>
                                        </p>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <p class="px-3">
                                            <i class="fas fa-restroom text-primary"></i><span class="ml-2 font-weight-bolder">{{ $item->nro_banos }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <a href="/web/verPropiedad/{{ $item->id }}/#propiedad" class="btn btn-primary mb-3">Más Información</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev w-auto" href="#propiedades .carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next w-auto" href="#propiedades .carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>

    <section id="contactenos" class="w-100 mb-3">
        <div class="section-title">
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <span class="name">Contáctenos</span>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
        </div>

        <div class="section-body container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card px-3 pt-3">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <h4 class="text-center"><strong>Informes</strong></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-article">
                                    <h4>Teléfonos</h4>
                                    <p>
                                        <ul>
                                            <li>(01) 4124743</li>
                                            <li>975388555</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-article">
                                    <h4>Dirección</h4>
                                    <p>
                                        <ul>
                                            <li>Jr. Las Cascadas 148 Of. 205 Urb. La Ensenada, La Molina</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-article">
                                    <h4>Correos</h4>
                                    <p>
                                        <ul>
                                            <li>nicsejecutores@gmail.com</li>
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card px-3 pt-3">
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <h4 class="text-center"><strong>Escríbenos</strong></h4>
                            </div>
                        </div>
                        <form id="formCorreo">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="alert" role="alert" id="alerta" style="display: none"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="emailContacto">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="emailContacto" required>
                                        <div class="invalid-feedback">
                                            Por favor indique su correo electrónico.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nombresContacto">Nombre Completo</label>
                                        <input type="text" class="form-control" id="nombresContacto" required>
                                        <div class="invalid-feedback">
                                            Por favor indique su nombre completo.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="asuntoContacto">Asunto</label>
                                        <input type="text" class="form-control" id="asuntoContacto" required>
                                        <div class="invalid-feedback">
                                            Por favor indique el asunto del mensaje.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="mensajeContacto">Mensaje</label>
                                        <textarea class="form-control" id="mensajeContacto" rows="3" required></textarea>
                                        <div class="invalid-feedback">
                                            Por favor indique el contenido del mensaje.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 text-center">
                                    <div class="form-group">
                                        <button id="enviarCorreo" class="btn btn-primary mb-2 px-5">ENVIAR</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

<script defer type="application/javascript">
    $(function() {
        $('.carousel-multiple').carousel({
            interval: 10000
        })

        $('.carousel-multiple .carousel-item').each(function(){
            var minPerSlide = 3;
            var next = $(this).next();
            if (!next.length) {
            next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i=0;i<minPerSlide;i++) {
                next=next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    });

    $("#enviarCorreo").on("click", function(e) {
        event.preventDefault();
        event.stopPropagation();

        var valido = true;
        var form = $("#formCorreo");

        if (form[0].checkValidity()) {
            event.target.checkValidity();
            var data = {
                correo: $("#emailContacto").val(),
                nombre: $("#nombresContacto").val(),
                asunto: $("#asuntoContacto").val(),
                mensaje: $("#mensajeContacto").val()
            }

            $("#alerta").removeClass("alert-success");
            $("#alerta").removeClass("alert-danger");
            $("#alerta").hide();

            $.post('{{ route('correo.enviar') }}',data)
                .done(function(response){
                    if (response.success){
                        $("#alerta").addClass('alert-success');
                        $("#alerta").text("Mensaje enviado correctamente");
                    } else {
                        $("#alerta").addClass('alert-danger');
                        $("#alerta").text("No se pudo enviar en el mensaje");
                    }
                    $("#alerta").show();
                })
                .fail(function(response){
                    $("#alerta").addClass('alert-danger');
                    $("#alerta").text("No se pudo enviar en el mensaje");
                    $("#alerta").show();
                });
        }

        form.addClass('was-validated');
    });
</script>

@endsection
