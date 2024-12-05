@extends('auth.index')

@section('titulo')
    <title>Registro de Horarios</title>
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
                Gestión de Horarios
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
            <div class="form-row">
                <form class="col-lg-12 col-md-12" action="{{ route('auth.horarios.store') }}" method="post">
                    @csrf
                    <div style="display: flex; flex-wrap: wrap;">
                        <div class="form-group col-lg-6">
                            <label for="time" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-clock"></i> Ingreso
                            </label>
                            <input autocomplete="off" type="time" class="form-control form-control-lg" id="ingreso"
                                name="ingreso" placeholder="Ingrese hora de ingreso" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="time_salida" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-clock"></i> Salida
                            </label>
                            <input autocomplete="off" type="time" class="form-control form-control-lg" id="salida"
                                name="salida" placeholder="Ingrese hora de salida" required>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("ingreso").focus();
                            });
                        </script>
                        <div class="form-group col-lg-6 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">
                                <i class="fa fa-save"></i> Registrar Horario
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <style>
            .table th,
            .table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            #tableCelula tbody tr:hover {
                cursor: pointer;
                /* Cambia el cursor a una mano cuando se pasa sobre la fila */
            }
        </style>

        <section class="content-header">
            @csrf
            <div class="row">
                <div class="col-md-12">

                    <table id="tableHorarios" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/horarios/index.js') }}"></script>
@endsection
