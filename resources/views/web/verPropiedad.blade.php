@extends('layouts.web')

@section('content')

    <section id="propiedad" class="w-100 mb-3">
        <div class="section-title">
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <span class="name">Descripción</span>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
            <i class="fas fa-star icon icon-small"></i>
        </div>
        <div class="section-body container">
            <div class="row">
                <div class="col-sm-6">
                    <div id="carouselPropiedad" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselPropiedad" data-slide-to="0" class="active"></li>

                            @foreach($model->propiedadFoto->getData()->data as $i => $item)
                                <li data-target="#carouselPropiedad" data-slide-to="{{ $i + 1 }}"></li>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block" src="/propiedad/mostrarImagen/{{ $model->propiedad->id }}" alt="Imagen">
                            </div>
                            @foreach($model->propiedadFoto->getData()->data as $i => $item)
                                <div class="carousel-item">
                                    <img class="d-block" src="/propiedadFoto/getImage/{{ $item->id }}" alt="Imagen">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselPropiedad" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselPropiedad" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="text-primary text-left"><strong>{{ $model->propiedad->tipo->descripcion }}</strong></h5>
                                    <h5 class="text-dark text-left"><strong>En {{ $model->propiedad->tipo_venta->descripcion }}</strong></h6>
                                </div>
                                <div class="col-sm-6">
                                    <h5 class="text-right"><strong>S/. {{ $model->propiedad->precio_soles }}</strong></h5>
                                    <h6 class="text-muted text-right"><strong>$ {{ $model->propiedad->precio_dolares }}</strong></h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="px-3">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <span class="ml-2">{{ $model->propiedad->direccion }}</span><br>
                                    <span class="ml-4">{{ $model->propiedad->ubigeo[0]->descripcion }}, {{ $model->propiedad->ubigeo[1]->descripcion }}, {{ $model->propiedad->ubigeo[2]->descripcion }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-center">
                                <p class="px-3">
                                    <i class="far fa-square text-primary"></i><span class="ml-2 font-weight-bolder">{{ $model->propiedad->area }} m<sup>2</sup></span>
                                </p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <p class="px-3">
                                    <i class="fas fa-bed text-primary"></i><span class="ml-2 font-weight-bolder">{{ $model->propiedad->nro_habitaciones }}</span>
                                </p>
                            </div>
                            <div class="col-sm-4 text-center">
                                <p class="px-3">
                                    <i class="fas fa-restroom text-primary"></i><span class="ml-2 font-weight-bolder">{{ $model->propiedad->nro_banos }}</span>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="px-3">
                                    <span><b>Descripción: </b></span><br>
                                    <span class="ml-3">{{ $model->propiedad->descripcion }}</span>
                                </p>
                            </div>
                        </div>
                        @if ($model->propiedadCaracteristica->getData()->recordsTotal > 0)
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="px-3">
                                        <span><b>Características: </b></span><br>
                                        <ul class="ml-3">
                                            @foreach($model->propiedadCaracteristica->getData()->data as $i => $item)
                                                <li>{{ $item->descripcion }}</li>
                                            @endforeach
                                        </ul>
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-sm-12 text-center">
                    <a href="{{ route('web.buscador') }}" class="btn btn-primary px-5">Ver Más</a>
                </div>
            </div>
        </div>
    </section>
@endsection
