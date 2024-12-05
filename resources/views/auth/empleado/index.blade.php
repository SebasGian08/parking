@extends('auth.index')

@section('titulo')
    <title>Registro de Empleado</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.6/JsBarcode.all.min.js"
        integrity="sha512-k2wo/BkbloaRU7gc/RkCekHr4IOVe10kYxJ/Q8dRPl7u3YshAQmg3WfZtIcseEk+nGBdK03fHBeLgXTxRmWCLQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                Gestión de Empleados
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
                <form class="col-lg-12 col-md-12" action="{{ route('auth.empleado.store') }}" method="post">
                    @csrf
                    <div style="display: flex; flex-wrap: wrap;">
                        <div class="form-group col-lg-6" style="margin-bottom: 0;">
                            <label for="dni" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-id-card"></i> DNI
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="dni"
                                name="dni" placeholder="Ingrese DNI" required maxlength="11" pattern="\d*"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <script>
                            document.getElementById('dni').addEventListener('input', function(e) {
                                this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                            });
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("dni").focus();
                            });
                        </script>

                        <div class="form-group col-lg-6">
                            <label for="nombre" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Nombre
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="nombre"
                                name="nombre" placeholder="Ingrese nombre" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="apellido" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-user"></i> Apellido
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="apellido"
                                name="apellido" placeholder="Ingrese apellido" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="cargo_id" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-briefcase"></i> Cargo
                            </label>
                            <select class="form-control form-control-lg" id="cargo_id" name="cargo_id" required>
                                <option value="" disabled selected>Seleccione cargo</option>
                                @foreach ($cargo as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6" style="margin-bottom: 0;">
                            <label for="tel" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-phone"></i> Teléfono
                            </label>
                            <input autocomplete="off" type="tel" class="form-control form-control-lg" id="tel"
                                name="tel" placeholder="Ingrese teléfono" maxlength="9" pattern="\d{9}"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="horario_id" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-calendar"></i> Horario
                            </label>
                            <select class="form-control form-control-lg" id="horario_id" name="horario_id" required>
                                <option value="" disabled selected>Seleccione horario</option>
                                @foreach ($horario as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->ingreso }} - {{ $item->salida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="email" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-envelope"></i> Email
                            </label>
                            <input autocomplete="off" type="email" class="form-control form-control-lg" id="email"
                                name="email" placeholder="Ingrese email" required>
                        </div>
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">
                            <i class="fa fa-save"></i> Registrar Empleado
                        </button>
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

                    <table id="tableEmpleado" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                </div>
            </div>
        </section>

    </div>








@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/empleado/index.js') }}"></script>
@endsection
