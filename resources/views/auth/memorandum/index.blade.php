@extends('auth.index')

@section('titulo')
    <title>Generar Memorandum</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Lista de Memorandum
            </h1>
        </section>
        <br>
        <div class="content-header">
            <div class="row">
                <form class="col-lg-4 col-md-4" action="{{ route('auth.memorandum.store') }}" method="post">
                    @csrf
                    <div class="form-group col-lg-12">
                        <label for="dniedit" class="m-0 label-primary">
                            DNI <b style="color:red;font-size:10px">(Obligatorio*)</b>
                        </label>
                        <div class="input-group">
                            <input type="hidden" name="id" required>
                            <input autocomplete="off" type="text" class="form-control form-control-sm" id="dni"
                                name="dni" placeholder="Ingresar DNI" minlength="1" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="buscardni" type="button"
                                    style="background-color: #0072bf; color: white;">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Por favor ingresa un DNI válido (entre 1 y 8 dígitos).
                        </div>
                    </div>
                    <script>
                        document.getElementById('dni').addEventListener('input', function(e) {
                            this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                        });
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById("dni").focus();
                        });
                    </script>
                    <div class="form-group col-lg-12">
                        <label for="empresa" class="m-0 label-primary">Empleado <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <input autocomplete="off" type="text" class="form-control form-control-sm" id="nombres"
                            name="nombres" value="{{ old('empresa') }}" required placeholder="Nombres y Apellidos" readonly>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="empresa" class="m-0 label-primary">Asunto <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <textarea autocomplete="off" type="text" class="form-control form-control-sm" id="asunto" name="asunto"
                            style="width: 100%; height: 200px;" required placeholder="Ingrese asunto">Es fundamental mantener una buena comunicación sobre cualquier dificultad que pueda surgir, así como el impacto que esto pueda tener en el equipo y en los proyectos en curso</textarea>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary" style="border-color:#2ecc71 !important;">Guardar
                            Memorandum</button>
                    </div>
                </form>
                <div class="col-lg-8 col-md-8">
                    <div class="table-wrapper">
                        <table id="tableMemorandum" class="display table table-bordered table-hover table-condensed">
                            <!-- Aquí se puede agregar un caption para la tabla si es necesario -->
                        </table>
                    </div>
                    <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                        <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                            <i class="fa fa-file"></i> Exportar excel
                        </a>
                    </div>
                </div>
                <style>
                    #tablePrograma {
                        max-width: 100%;
                        /* Asegura que la tabla ocupe todo el ancho del contenedor */
                    }
                </style>
            </div>
        </div>


    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/memorandum/index.js') }}"></script>
@endsection
