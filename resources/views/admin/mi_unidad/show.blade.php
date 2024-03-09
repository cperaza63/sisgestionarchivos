@extends('layouts.admin')
@section('content')

    <div class="row mb-2">

        <div class="col-sm-10">
            <div class="col-md-3 col-sm-6 col-12">
                <a href="#" style="color:black">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far"><i class="bi bi-folder"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h6><strong>{{ $carpeta->nombre}}</strong></h6>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        </div><!-- /.col -->
        <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
                <!-- Button trigger modal -->
                <a class='btn btn-info mr-0' href="{{ url('/admin/mi_unidad') }}"><i class="bi"><i class="bi-arrow-bar-left"></i></i>
                </a>
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-folder-fill"></i> Crear
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nombre de la carpeta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/admin/mi_unidad/carpeta') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="text" name = "carpeta_padre_id" value="{{ $carpeta->id }}" hidden>
                                                <input type="text" class="form-control" name="nombre" required
                                                    placeholder="Coloque el nombre de la nueva categoia">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Crear</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->




    <hr>

    <h5 class="m-0">Carpetas y Archivos</h5>

    <hr>

    <div class="row">
        @foreach ($subcarpetas as $subcarpeta)
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ url('/admin/mi_unidad/carpeta',$subcarpeta->id) }}" style="color:black">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far"><i class="bi bi-folder"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h6><strong>{{ $subcarpeta->nombre}}</strong></h6>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @endsection
