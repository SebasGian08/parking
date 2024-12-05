<div id="modalMantenimientoParticipantes" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" action="{{ route('auth.programa.storeParticipantes') }}"
            id="registroParticipantes" method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroParticipantes" data-ajax-failure="OnFailureRegistroParticipantes">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Añadir Participante </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="id_programa" class="id_programa"
                            value="{{ $Entity != null ? $Entity->id : '' }}" required>
                        {{-- {{ $Entity != null ? $Entity->id : '' }}  --}}
                        <div class="row justify-content-center mt-1">
                            <div class="col-lg-12">
                                <div class="alert alert-success" role="alert">
                                    <span class="fa fa-check-circle"></span> <!-- Icono de check -->
                                    {{-- Mensaje --}}
                                    ¡Genial! Estás añadiendo participantes para el programa de la empresa
                                    {{ $Entity != null ? $Entity->empresa : '' }} con el tipo de programa
                                    {{ $Entity != null ? $Entity->tipo_programa : '' }}, registrado para el
                                    {{ $Entity != null ? $Entity->registro : '' }}.
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="form-group col-lg-6">
                                <label for="dni" class="m-0 label-primary">DNI <b
                                        style="color:red;font-size:10px">(Obligatorio*)</b></label>
                                <div class="input-group">
                                    <input autocomplete="off" type="text" class="form-control form-control-sm"
                                        id="dni" name="dni" placeholder="Ingresar DNI" minlength="1"
                                        required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="buscardni" type="button"
                                            style="background-color: #0072bf; color: white;">
                                            <i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa un DNI válido (entre 1 y 8 dígitos).
                                </div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="nombre" class="m-0 label-primary">Nombres</label>
                                <input autocomplete="off" type="text" class="form-control form-control-sm"
                                    id="nombres" name="nombres" placeholder="Nombres" readonly required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="apellidos" class="m-0 label-primary">Apellidos</label>
                                <input autocomplete="off" type="text" class="form-control form-control-sm"
                                    id="apellidos" name="apellidos" placeholder="Apellidos" readonly required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="especialidad" class="m-0 label-primary">Programa de Estudio</label>
                                <input autocomplete="off" type="text" class="form-control form-control-sm"
                                    id="especialidad" name="especialidad" placeholder="Programa de estudio" readonly required>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="telefono" class="m-0 label-primary">Teléfono</label>
                                <input autocomplete="off" type="tel" class="form-control form-control-sm"
                                    id="tel" name="tel" placeholder="Teléfono">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="correo" class="m-0 label-primary">Correo Electrónico</label>
                                <input autocomplete="off" type="email" class="form-control form-control-sm"
                                    id="email" name="email" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="estado" class="m-0 label-primary">Estado <b
                                        style="color:red;font-size:10px">(Obligatorio*)</b></label>
                                <select name="estado" id="estado" class="form-control form-control-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="Postulante" {{ old('estado') == 'Postulante' ? 'selected' : '' }}>
                                        Postulante
                                    </option>
                                    <option value="Evaluando" {{ old('estado') == 'Evaluando' ? 'selected' : '' }}>
                                        Evaluando</option>
                                    <option value="Contratado" {{ old('estado') == 'Contratado' ? 'selected' : '' }}>
                                        Contratado
                                    </option>
                                    <option value="Descartado" {{ old('estado') == 'Descartado' ? 'selected' : '' }}>
                                        Descartado
                                    </option>


                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="tipo" class="m-0 label-primary">Tipo <b
                                        style="color:red;font-size:10px">(Obligatorio*)</b></label>
                                <select name="tipo" id="tipo" class="form-control form-control-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="Estudiante" {{ old('tipo') == 'Estudiante' ? 'selected' : '' }}>
                                        Estudiante
                                    </option>
                                    <option value="Egresado" {{ old('tipo') == 'Egresado' ? 'selected' : '' }}>
                                        Egresado
                                    </option>
                                    <option value="Titulado" {{ old('tipo') == 'Titulado' ? 'selected' : '' }}>
                                        Titulado
                                    </option>

                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="sede" class="m-0 label-primary">Sede <b
                                        style="color:red;font-size:10px">(Obligatorio*)</b></label>
                                <select name="sede" id="sede" class="form-control form-control-sm" required>
                                    <option value="">Seleccione</option>
                                    <option value="AREQUIPA 09 - CERCADO DE LIMA"
                                        {{ old('sede') == 'AREQUIPA 09 - CERCADO DE LIMA' ? 'selected' : '' }}>
                                        AREQUIPA 09 - CERCADO DE LIMA
                                    </option>
                                    <option value="AREQUIPA 14 - CERCADO DE LIMA"
                                        {{ old('sede') == 'AREQUIPA 14 - CERCADO DE LIMA' ? 'selected' : '' }}>
                                        AREQUIPA 14 - CERCADO DE LIMA
                                    </option>
                                    <option value="ATE 01 (NICOLAS AYLLON 831)"
                                        {{ old('sede') == 'ATE 01 (NICOLAS AYLLON 831)' ? 'selected' : '' }}>
                                        ATE 01 (NICOLAS AYLLON 831)
                                    </option>
                                    <option value="BELISARIO - SAN JUAN DE MIRAFLORES"
                                        {{ old('sede') == 'BELISARIO - SAN JUAN DE MIRAFLORES' ? 'selected' : '' }}>
                                        BELISARIO - SAN JUAN DE MIRAFLORES
                                    </option>
                                    <option value="BILLINGHURST - SAN JUAN DE MIRAFLORES"
                                        {{ old('sede') == 'BILLINGHURST - SAN JUAN DE MIRAFLORES' ? 'selected' : '' }}>
                                        BILLINGHURST - SAN JUAN DE MIRAFLORES
                                    </option>
                                    <option value="CHOTA - CERCADO DE LIMA"
                                        {{ old('sede') == 'CHOTA - CERCADO DE LIMA' ? 'selected' : '' }}>
                                        CHOTA - CERCADO DE LIMA
                                    </option>
                                    <option value="CENTRAL - CERCADO DE LIMA"
                                        {{ old('sede') == 'CENTRAL - CERCADO DE LIMA' ? 'selected' : '' }}>
                                        CENTRAL - CERCADO DE LIMA
                                    </option>
                                    <option value="CLÍNICA - CERCADO DE LIMA"
                                        {{ old('sede') == 'CLÍNICA - CERCADO DE LIMA' ? 'selected' : '' }}>
                                        CLÍNICA - CERCADO DE LIMA
                                    </option>
                                    <option value="ELEKTRA - FUENTE PIEDRA"
                                        {{ old('sede') == 'ELEKTRA - FUENTE PIEDRA' ? 'selected' : '' }}>
                                        ELEKTRA - FUENTE PIEDRA
                                    </option>
                                    <option value="HORACIO ZEVALLOS"
                                        {{ old('sede') == 'HORACIO ZEVALLOS' ? 'selected' : '' }}>
                                        HORACIO ZEVALLOS
                                    </option>
                                    <option value="LOS CHINOS - SAN JUAN DE MIRAFLORES"
                                        {{ old('sede') == 'LOS CHINOS - SAN JUAN DE MIRAFLORES' ? 'selected' : '' }}>
                                        LOS CHINOS - SAN JUAN DE MIRAFLORES
                                    </option>
                                    <option value="MENDIOLA - LOS OLIVOS"
                                        {{ old('sede') == 'MENDIOLA - LOS OLIVOS' ? 'selected' : '' }}>
                                        MENDIOLA - LOS OLIVOS
                                    </option>
                                    <option value="MIGUEL IGLESIAS - SAN JUAN DE MIRAFLORES"
                                        {{ old('sede') == 'MIGUEL IGLESIAS - SAN JUAN DE MIRAFLORES' ? 'selected' : '' }}>
                                        MIGUEL IGLESIAS - SAN JUAN DE MIRAFLORES
                                    </option>
                                    <option value="PTE PIEDRA 2"
                                        {{ old('sede') == 'PTE PIEDRA 2' ? 'selected' : '' }}>
                                        PTE PIEDRA 2
                                    </option>
                                    <option value="SJL 10 - SAN JUAN DE LURIGANCHO"
                                        {{ old('sede') == 'SJL 10 - SAN JUAN DE LURIGANCHO' ? 'selected' : '' }}>
                                        SJL 10 - SAN JUAN DE LURIGANCHO
                                    </option>
                                    <option value="SJL CDRA 22 - SAN JUAN DE LURIGANCHO"
                                        {{ old('sede') == 'SJL CDRA 22 - SAN JUAN DE LURIGANCHO' ? 'selected' : '' }}>
                                        SJL CDRA 22 - SAN JUAN DE LURIGANCHO
                                    </option>
                                    <option value="SJL 50 - SAN JUAN DE LURIGANCHO"
                                        {{ old('sede') == 'SJL 50 - SAN JUAN DE LURIGANCHO' ? 'selected' : '' }}>
                                        SJL 50 - SAN JUAN DE LURIGANCHO
                                    </option>
                                    <option value="SALAVERRY - LOS OLIVOS"
                                        {{ old('sede') == 'SALAVERRY - LOS OLIVOS' ? 'selected' : '' }}>
                                        SALAVERRY - LOS OLIVOS
                                    </option>
                                    <option value="SAN LÁZARO - INDEPENDENCIA"
                                        {{ old('sede') == 'SAN LÁZARO - INDEPENDENCIA' ? 'selected' : '' }}>
                                        SAN LÁZARO - INDEPENDENCIA
                                    </option>
                                    <option value="VILLA EL SALVADOR"
                                        {{ old('sede') == 'VILLA EL SALVADOR' ? 'selected' : '' }}>
                                        VILLA EL SALVADOR
                                    </option>
                                    <option value="VISTA ALEGRE"
                                        {{ old('sede') == 'VISTA ALEGRE' ? 'selected' : '' }}>
                                        VISTA ALEGRE
                                    </option>
                                </select>
                            </div>
                            <style>

                            </style>
                            <div class="form-group col-lg-12">
                                <!-- Botón de Envío -->
                                <button type="submit" class="btn btn-primary "
                                    style="background-color:#2ecc71; border-color:#2ecc71; color:#fff;">
                                    <i class="fa fa-user-plus"></i> Registrar participante
                                </button>
                                <!-- Botón de Cancelar (opcional) -->
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                                    <i class="fa fa-times"></i> Cancelar
                                </button> --}}
                            </div>


                        </div>
                    </div>

                    <div>
                        <div class="col-lg-12 col-md-12">
                            <div class="table-wrapper">
                                <table id="tableParticipantes"
                                    class="display table table-bordered table-hover table-condensed">
                                    <thead>
                                        {{-- Contenido de JS --}}
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    // Define las variables en el contexto global de JavaScript
    var userProfileId = @json(Auth::guard('web')->user()->profile_id);
    var PERFIL_DESARROLLADOR = @json(\BolsaTrabajo\App::$PERFIL_DESARROLLADOR);
</script>
<script type="text/javascript" src="{{ asset('auth/js/programa/_Participantes.js') }}"></script>
