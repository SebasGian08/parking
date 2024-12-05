<div id="modalMantenimientEdit" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.asistentes.update') }}" id="registroEditAsistente"
            method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroEditAsistente" data-ajax-failure="OnFailureRegistroEditAsistente">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $Entity != null ? 'Modificar' : 'Registrar' }} Asistentes
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">

                    <div class="form-group">
                        <div class="row">
                            <!-- Nombres Field -->
                            <div class="form-group col-lg-6">
                                <label for="nombre" class="m-0 label-primary">
                                    Nombres <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="nombre" id="nombre"
                                        value="{{ $Entity ? $Entity->nombre : '' }}" autocomplete="off" required>
                                </div>
                            </div>
                            <!-- Apellidos Field -->
                            <div class="form-group col-lg-6">
                                <label for="apellido" class="m-0 label-primary">
                                    Apellidos <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="apellido" id="apellido"
                                        value="{{ $Entity ? $Entity->apellido : '' }}" autocomplete="off" required>
                                </div>
                            </div>
                            <!-- Fecha de Nacimiento Field -->
                            <div class="form-group col-lg-6">
                                <label for="fecha_nac" class="m-0 label-primary">
                                    Fecha de Nacimiento <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="date" class="form-input" name="fecha_nac" id="fecha_nac"
                                        value="{{ $Entity ? $Entity->fecha_nac : '' }}" required>
                                </div>
                            </div>
                            <!-- Distrito Field -->
                            <div class="form-group col-lg-6">
                                <label for="distrito_id" class="m-0 label-primary">
                                    Distrito <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <select class="form-control" name="distrito_id" id="distrito_id" required>
                                        @foreach ($distritos as $distrito)
                                            <option value="{{ $distrito->id }}"
                                                {{ $Entity && $Entity->distrito_id == $distrito->id ? 'selected' : '' }}>
                                                {{ $distrito->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Dirección Field -->
                            <div class="form-group col-lg-6">
                                <label for="direccion" class="m-0 label-primary">
                                    Dirección <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="direccion" id="direccion"
                                        value="{{ $Entity ? $Entity->direccion : '' }}" autocomplete="off" required>
                                </div>
                            </div>
                            <!-- Teléfono Field -->
                            <div class="form-group col-lg-6">
                                <label for="telefono" class="m-0 label-primary">
                                    Teléfono <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="tel" id="tel"
                                        value="{{ $Entity ? $Entity->tel : '' }}" autocomplete="off" required>
                                </div>
                            </div>
                            <!-- Género Field -->
                            <div class="form-group col-lg-6">
                                <label for="genero" class="m-0 label-primary">
                                    Género <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <select class="form-control" name="genero" id="genero" required>
                                        <option value="masculino"
                                            {{ $Entity && $Entity->genero == 'masculino' ? 'selected' : '' }}>Masculino
                                        </option>
                                        <option value="femenino"
                                            {{ $Entity && $Entity->genero == 'masculino' ? 'selected' : '' }}>Femenino
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <!-- Célula Field -->
                            <div class="form-group col-lg-6">
                                <label for="celula_id" class="m-0 label-primary">
                                    Célula <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <select class="form-control" name="celula_id" id="celula_id" required>
                                        @foreach ($celulas as $celula)
                                            <option value="{{ $celula->id }}"
                                                {{ $Entity && $Entity->celula_id == $celula->id ? 'selected' : '' }}>
                                                {{ $celula->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Estado Field -->
                            <div class="form-group col-lg-6">
                                <label for="estado" class="m-0 label-primary">
                                    Estado <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <select class="form-control" name="estado" id="estado" required>
                                        <option value="1"
                                            {{ $Entity && $Entity->estado == '1' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="2"
                                            {{ $Entity && $Entity->estado == '2' ? 'selected' : '' }}>Inactivo
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="banner_anuncio" class="m-0 label-primary"
                                    style="font-size: 15px;">Fotografía</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control-lg" id="foto"
                                        name="foto" onchange="validateFile(this)">
                                    <label class="custom-file-label" for="banner_anuncio"
                                        id="banner_label">Seleccionar
                                        archivo...</label>
                                </div>
                                <small id="fileHelp" class="form-text text-muted">Selecciona un archivo JPG o PNG.
                                    (Se
                                    recomienda 1200x1200px)</small>
                                @error('banner')
                                    <div class="alert alert-danger mt-2">
                                        <i class="fa fa-exclamation-circle"></i> <!-- Add Icono de advertencia -->
                                        <span class="ml-1">{{ $message }}</span>
                                    </div>
                                @enderror
                                <span id="fileError" class="text-danger"></span>
                                @if ($Entity && $Entity->foto)
                                    <div class="mt-2">
                                        <img src="{{ asset($Entity->foto) }}" alt="Foto" class="img-thumbnail"
                                            style="max-width: 200px;">
                                    </div>
                                @endif
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
                            {{-- Fin Codigo --}}
                        </div>
                    </div>

                </div>
                <div class="form-group col-lg-12">
                    <!-- Botón de Envío -->
                    <hr>
                    <button type="submit" class="btn btn-primary "
                        style="background-color:#2ecc71; border-color:#2ecc71; color:#fff;">
                        <i class="fa fa-user-plus"></i> Editar Participante
                    </button>
                    <!-- Botón de Cancelar (opcional) -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>





<script type="text/javascript" src="{{ asset('auth/js/asistentes/Editar.js') }}"></script>
