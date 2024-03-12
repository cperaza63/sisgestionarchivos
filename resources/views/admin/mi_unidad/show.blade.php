@extends('layouts.admin')
@section('content')

    <!-- conectamos con la libreria de dropzone -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css">
    <!-- fin de la conexion -->

    <div class="row mb-2">

        <div class="col-sm-9">
            <div class="col-md-5 col-sm-6 col-12">
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
        <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                <!-- Button trigger modal -->
                <a title="Regresar al menu Carpetas" class='btn btn-info mr-1' href="{{ url('/admin/mi_unidad') }}"><i class="bi"><i class="bi-arrow-bar-left"></i></i>
                </a>
                <button title="Subir nuevos archivos" type="button" class="btn btn-info mr-1" data-toggle="modal" data-target="#modal_cargar_archivos">
                    <i class="bi bi-cloud-upload-fill"></i>
                </button>


                                <!-- Modal para cargar archivos-->
                                <div class="modal fade" id="modal_cargar_archivos" tabindex="-1" aria-labelledby="modalCargarArchivos"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cargando Archivos a la Carpeta</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/admin/mi_unidad/carpeta') }}" method="post" enctype="multipart/form-data" class="dropzone" id="myDropzone">
                                                @csrf

                                                <input type="text" name="id" value="{{ $carpeta->id }}" hidden>
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple />
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <!--<button type="submit" class="btn btn-success">Crear</button>-->
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <script>
                                Dropzone.options.myDropzone = {
                                    paranName: "file",
                                    dictDefaultMessage: 'Arrastra y suelta los archivos aqui, o has click para seleccionar los archivos',
                                };
                            </script>


                <button title="Crear nuevas carpetas" type="button" class="btn btn-info mr-1" data-toggle="modal" data-target="#exampleModal">
                    <i class="bi bi-folder-plus"></i>
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
            <div class="col-md-3 mb-2">
                <div class="divcontent" data-toggle="tooltip" data-placement="bottom" title="{{$subcarpeta->nombre}}">
                    <div class="row" style="padding: 10px; margin-top:10px;">
                        <div class="col-2 mt-2 mb-2" style="text-align:center">
                            <i class="bi bi-folder fa-lg" style="fot-size:20pt; color:{{ $subcarpeta->color }}"></i>
                        </div>
                        <div class="col-8  mt-2 mb-2">
                            <a href="{{ url('/admin/mi_unidad/carpeta',$subcarpeta->id) }}" style="color:black">
                            {{ $subcarpeta->nombre }}
                            </a>
                        </div>
                        <div class="col-2 mt-2 mb-2" style="text-align:right">
                            <div class="btn-group" role="group">
                                <button type="button" class="dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="#"
                                        data-toggle="modal" data-target="#modal_cambiar_nombre{{$subcarpeta->id}}">
                                        <i class="bi bi-pencil"></i> Editar</a>

                                        <a href="#" class="dropdown-item">
                                        <i class="bi bi-gear"></i> Color de Carpeta <br>
                                            <div class="btn-group" role="group" alias-label="Basic Example">
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{$subcarpeta->id}}" >
                                                    <input name="color" type="text" value="blue" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:blue"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{$subcarpeta->id}}" hidden>
                                                    <input name="color" type="text" value="red" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:red"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{$subcarpeta->id}}" hidden>
                                                    <input name="color" type="text" value="green" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:green"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{$subcarpeta->id}}" hidden>
                                                    <input name="color" type="text" value="orange" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:orange"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{$subcarpeta->id}}" hidden>
                                                    <input name="color" type="text" value="brown" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:brown"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </a>
                                        <hr>
                                        <a href="#" class="dropdown-item"><i class="bi bi-trash"></i> Eliminar</a>


                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal para cambier el nombre de la carpeta -->
            <div class="modal fade" id="modal_cambiar_nombre{{ $subcarpeta->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cambiar Nombre</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/admin/mi_unidad') }}" method="post">

                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input name="id" type="text" value={{ $subcarpeta->id }} hidden>
                                            <input type="text" class="form-control" name="nombre" required
                                                value="{{ $subcarpeta->nombre }}"
                                                placeholder="Coloque el nombre de la nueva categoia">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-3 col-sm-6 col-12">
                <a href="{ { url('/admin/mi_unidad/carpeta',$subcarpeta->id) }}" style="color:black">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far"><i class="bi bi-folder"></i></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">
                                <h6><strong>{ { $subcarpeta->nombre}}</strong></h6>
                            </span>
                        </div>
                    </div>
                </a>
            </div>-->
        @endforeach
    </div>

    @endsection
