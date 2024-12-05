@extends('auth.index')

@section('titulo')
    <title>JAC | Registro de Asistentes</title>
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
                Gestión de Asistentes
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
                <form class="col-lg-12 col-md-12" action="{{ route('auth.asistentes.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div style="display: flex; flex-wrap: wrap;">
                        <div class="form-group col-lg-6">
                            <label for="nombre" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Nombre del Asistente
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="nombre"
                                name="nombre" placeholder="Ingrese nombre del asistente" required style="text-transform: uppercase;">
                        </div>
                        
                        <div class="form-group col-lg-6">
                            <label for="apellidos" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Apellidos
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="apellido"
                                name="apellido" placeholder="Ingrese apellidos del asistente" required style="text-transform: uppercase;">
                        </div>
                        

                        <div class="form-group col-lg-6">
                            <label for="fecha_nac" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-calendar"></i> Fecha de Nacimiento
                            </label>
                            <input autocomplete="off" type="date" class="form-control form-control-lg" id="fecha_nac"
                                name="fecha_nac" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="distrito" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-map-marker"></i> Distrito
                            </label>
                            <select class="form-control form-control-lg" id="distrito_id" name="distrito_id" required>
                                <option value="" disabled selected>Seleccione Distrito</option>
                                @foreach ($distritos as $distritos)
                                    <option value="{{ $distritos->id }}">{{ $distritos->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="direccion" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-home"></i> Dirección
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="direccion"
                                name="direccion" placeholder="Ingrese dirección del asistente">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="telefono" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-phone"></i> Teléfono/Celular
                            </label>
                            <input autocomplete="off" type="tel" class="form-control form-control-lg" min="6"
                                id="tel" name="tel" placeholder="Ingrese número de teléfono"
                                oninput="this.value = this.value.replace(/\D/g, '')">
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="genero" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-genderless"></i> Género
                            </label>
                            <select class="form-control form-control-lg" id="genero" name="genero" required>
                                <option value="" disabled selected>Seleccione su género</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="celula" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-tag"></i> Célula
                            </label>
                            <select class="form-control form-control-lg" id="celula_id" name="celula_id" required>
                                <option value="" disabled selected>Seleccione Celula..</option>
                                @foreach ($celulas as $celula)
                                    <option value="{{ $celula->id }}">{{ $celula->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="banner_anuncio" class="m-0 label-primary" style="font-size: 15px;">
                                Fotografía <span style="font-size: 12px; color: #008f40;">(opcional)</span>
                            </label>
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control-lg" id="foto"
                                    name="foto" onchange="validateFile(this)">
                                <label class="custom-file-label" for="banner_anuncio" id="banner_label">Seleccionar
                                    archivo...</label>
                            </div>
                            <small id="fileHelp" class="form-text text-muted">Selecciona un archivo JPG o PNG. (Se
                                recomienda 1200x1200px)</small>
                            @error('banner')
                                <div class="alert alert-danger mt-2">
                                    <i class="fa fa-exclamation-circle"></i> <!-- Add Icono de advertencia -->
                                    <span class="ml-1">{{ $message }}</span>
                                </div>
                            @enderror
                            <span id="fileError" class="text-danger"></span>
                            <!-- Add Aquí se mostrará el mensaje de error -->
                        </div>
                        {{-- Codigo Sebastian --}}
                        <script>
                            function validateFile(input) {
                                var fileName = input.files[0].name;
                                var label = document.getElementById('banner_label');
                                var fileError = document.getElementById('fileError');
                                var validExtensions = ['jpg', 'jpeg', 'png']; // Extensiones válidas

                                // Obtener la extensión del archivo seleccionado
                                var fileExtension = fileName.split('.').pop().toLowerCase();

                                // Verificar si la extensión es válida
                                if (validExtensions.indexOf(fileExtension) == -1) {
                                    label.innerText = 'Seleccionar archivo...';
                                    fileError.innerHTML =
                                        '<i class="fa fa-exclamation-circle"></i> Error: Seleccione un archivo JPG o PNG válido.';
                                    input.value = ''; // Limpiar el valor del input file
                                } else {
                                    label.innerText = fileName;
                                    fileError.innerText = '';
                                }
                            }
                        </script>
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">
                            <i class="fa fa-save"></i> Registrar Asistente
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
        </style>

        <section class="content-header">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">
                            <span class="fa fa-check-circle"></span> <!-- Icono de check -->
                            <strong>¡Atención!</strong> Los participantes con una fila de color amarillo han alcanzado la mayoría de edad.
                        </div>
                    </div>
                    
                    <table id="tableAsistentes" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                    <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                        <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                            <i class="fa fa-file"></i> Reporte de Asistentes
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/asistentes/index.js') }}"></script>
@endsection
