@extends('auth.index')

@section('titulo')
    <title>JAC | Registro de Asistencia</title>
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
                <i class="fas fa-user-check"></i> Registrar Seguimiento
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
                <form class="col-lg-12 col-md-12" action="{{ route('auth.seguimiento.store') }}" method="post">
                    @csrf
                    <div style="display: flex; flex-wrap: wrap;">

                        <div class="form-group col-lg-12">
                            <label for="fecha_contacto" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-calendar-day"></i> Fecha de la Última Sesión de Discipulado
                            </label>
                            <input type="date" class="form-control form-control-lg" id="fecha_contacto"
                                name="fecha_contacto" required>
                        </div>

                        <!-- Célula -->
                        <div class="form-group col-lg-6">
                            <label for="celula" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-users"></i> Célula
                            </label>
                            <select class="form-control form-control-lg" id="celula_id" name="celula_id" required>
                                <option value="" disabled selected>Seleccione Célula..</option>
                                @foreach ($celula as $celula)
                                    <option value="{{ $celula->id }}">{{ $celula->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                         <!-- Asistentes - Opción 1 -->
                         <div class="form-group col-lg-6">
                            <label for="asistentes" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-user"></i> Asistentes
                            </label>
                            <select class="form-control form-control-lg" id="asistente_id" name="asistente_id" required>
                                <option value="" disabled selected>Seleccione Asistente..</option>
                                <!-- Opciones dinámicas aquí -->
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="tipo-contacto" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-phone"></i> Tipo de Contacto
                            </label>
                            <select class="form-control form-control-lg" id="tipo_contacto" name="tipo_contacto" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Llamada">Llamada</option>
                                <option value="Mensaje">Mensaje WhatsApp</option>
                                <option value="reunion">Reunión en persona</option>
                                <option value="nocontesta">No contesta</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="detalle" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-info-circle"></i> Detalles del Último Contacto
                            </label>
                            <textarea class="form-control form-control-sm" id="detalle" name="detalle" rows="3" required></textarea>
                        </div>

                        <div class="form-group col-lg-12">
                            <label for="oracion" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-praying-hands"></i> Peticiones de Oración Específicas
                            </label>
                            <textarea class="form-control form-control-sm" id="oracion" name="oracion" rows="3" required></textarea>
                        </div>

                       
                    </div>
                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg" style="font-size: 17px;border-radius:15px;">
                            <i class="fa fa-save"></i> Registrar Seguimiento</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/seguimiento/index.js') }}"></script>
    <script>
        var csrfToken = '{{ csrf_token() }}';
    </script>
@endsection
