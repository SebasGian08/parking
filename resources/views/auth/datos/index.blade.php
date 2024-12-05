@extends('auth.index')

@section('titulo')
    <title>Registro de Empresa</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <style>
        .activo {
            background-color: green;
            color: white;
        }

        .inactivo {
            background-color: red;
            color: white;
        }
    </style>
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Datos de la empresa
            </h1>
        </section>

        <br>
        <div class="content-header">
            <div class="row align-items-center">
                <!-- Contenedor para los mensajes -->
                <div class="col-lg-12">
                    <!-- Mensaje de éxito -->
                    @if (session('success'))
                        <div class="alert alert-success d-flex align-items-center" role="alert">
                            <i class="fa fa-check-circle me-2"></i> <!-- Icono de éxito -->
                            <div>
                                <ul class="mb-0">
                                    {{ session('success') }}
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- Mensaje de error -->
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fa fa-exclamation-triangle me-2"></i> <!-- Icono de error -->
                            <div>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="container">
                @if ($empresa)
                    <!-- Pestañas -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="empresa-tab" data-toggle="tab" href="#empresa" role="tab"
                                aria-controls="empresa" aria-selected="true">Datos de Empresa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="adicionales-tab" data-toggle="tab" href="#adicionales" role="tab"
                                aria-controls="adicionales" aria-selected="false">Datos Adicionales</a>
                        </li>
                    </ul>
                    <!-- Contenido de las pestañas -->
                    <form action="{{ route('auth.datos.update') }}" method="post" enctype="multipart/form-data"
                        style="margin-top: 20px;">
                        @csrf

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="empresa" role="tabpanel"
                                aria-labelledby="empresa-tab">
                                <div class="form-group">
                                    <label for="nombre">Nombre de Empresa <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="{{ old('nombre', $empresa->nombre) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="ruc">RUC <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="ruc" name="ruc"
                                        value="{{ old('ruc', $empresa->ruc) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        value="{{ old('direccion', $empresa->direccion) }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $empresa->email) }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tel">Teléfono</label>
                                    <input type="text" class="form-control" id="tel" name="tel"
                                        value="{{ old('tel', $empresa->tel) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="logo">Logo <span class="text-danger">*</span></label>
                                    @if ($empresa->logo)
                                        <div>
                                            <img src="{{ asset($empresa->logo) }}" alt="Logo actual"
                                                style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control" id="logo" name="logo"
                                        accept="image/*">
                                    <small class="form-text text-muted">Sube un nuevo logo si deseas cambiarlo.</small>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="adicionales" role="tabpanel" aria-labelledby="adicionales-tab">
                                <div class="form-group">
                                    <label for="web">Sitio Web</label>
                                    <input type="url" class="form-control" id="web" name="web"
                                        value="{{ old('web', $empresa->web) }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Editar datos</button>
                    </form>
                @else
                    <p>No se encontraron datos de la empresa.</p>
                @endif
            </div>


            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    document.getElementById("nombre").focus();
                });
            </script>


        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/cargo/index.js') }}"></script>
@endsection
