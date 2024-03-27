@extends('layouts/admin')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">MI Unidad</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                            <i class="bi bi-folder-fill"></i> Nueva Carpeta
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
                                        <form action="{{ url('/admin/mi_unidad') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
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
        </div><!-- /.container-fluid -->
    </div>
    <hr>
    <div class="container">
        <div class="row m-5">
            @foreach ($carpetas as $carpeta)
                <div class="col-md-3 mb-2">
                    <div class="divcontent" data-toggle="tooltip" data-placement="bottom" title="{{ $carpeta->nombre }}">
                        <div class="row" style="padding: 10px; margin-top:10px;">
                            <div class="col-2 mt-2 mb-2" style="text-align:center">
                                <i class="bi bi-folder-fill fa-lg" style="fot-size:20pt;color:{{ $carpeta->color }}"></i>
                            </div>
                            <div class="col-8  mt-2 mb-2">
                                <a href="{{ url('/admin/mi_unidad/carpeta', $carpeta->id) }}" style="color:black">
                                    {{ $carpeta->nombre }}
                                </a>
                            </div>
                            <div class="col-1 mt-1 mb-2" style="text-align:right">
                                <div class="btn-group" role="group">

                                    <button type="button" class="dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#modal_cambiar_nombre{{ $carpeta->id }}">
                                            <i class="bi bi-pencil"></i> Editar</a>

                                        <a href="#" class="dropdown-item">
                                            <i class="bi bi-gear"></i> Color de Carpeta <br>
                                            <div class="btn-group" role="group" alias-label="Basic Example">
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{ $carpeta->id }}" hidden>
                                                    <input name="color" type="text" value="blue" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:blue"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{ $carpeta->id }}" hidden>
                                                    <input name="color" type="text" value="red" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:red"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{ $carpeta->id }}"
                                                        hidden>
                                                    <input name="color" type="text" value="green" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:green"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{ $carpeta->id }}"
                                                        hidden>
                                                    <input name="color" type="text" value="orange" hidden>
                                                    <button type="submit" style="background-color:white; border:0px;">
                                                        <i class="bi bi-circle-fill" style="color:orange"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ url('/admin/mi_unidad/color') }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input name="id" type="text" value="{{ $carpeta->id }}"
                                                        hidden>
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
                <div class="modal fade" id="modal_cambiar_nombre{{ $carpeta->id }}" tabindex="-1"
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
                                                <input name="id" type="text" value={{ $carpeta->id }} hidden>
                                                <input type="text" class="form-control" name="nombre" required
                                                    value="{{ $carpeta->nombre }}"
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
            @endforeach
        </div>
    </div>




    <!-- <div class="col-md-3 col-sm-6 col-12">
                        <a href="{ { url('/admin/mi_unidad/carpeta',$carpeta->id) }}" style="color:black">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="far"><i class="bi bi-folder"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">
                                        <h6><strong>{ { $carpeta->nombre}}</strong></h6>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                -->
@endsection
