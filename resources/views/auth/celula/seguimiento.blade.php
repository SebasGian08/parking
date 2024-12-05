<div id="modalMantenimientoParticipantes" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" action="{{ route('auth.celula.storeSeguimiento') }}" id="registroParticipantes"
            method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Registrar Seguimiento a {{ $Entity != null ? $Entity->apellido : '' }},
                        {{ $Entity != null ? $Entity->nombre : '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <input type="hidden" name="asistente_id" class="asistente_id" id='asistente_id'
                            value="{{ $Entity != null ? $Entity->id : '' }}" required>
                        <input type="hidden" name="celula_id" class="celula_id" id='celula_id'
                            value="{{ $Entity != null ? $Entity->celula_id : '' }}" required>
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
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="form-group col-lg-6">
                                <label for="fecha_contacto" class="m-0 label-primary" style="font-size: 15px;">
                                    <i class="fa fa-calendar-day"></i> Fecha de la Última Sesión de Discipulado
                                </label>
                                <input type="date" class="form-control form-control-sm" id="fecha_contacto"
                                    name="fecha_contacto" required>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="tipo-contacto" class="m-0 label-primary" style="font-size: 15px;">
                                    <i class="fa fa-phone"></i> Tipo de Contacto
                                </label>
                                <select class="form-control form-control-sm" id="tipo_contacto" name="tipo_contacto"
                                    required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Llamada">Llamada</option>
                                    <option value="Mensaje">Mensaje WhatsApp</option>
                                    <option value="reunion">Reunión en persona</option>
                                    <option value="nocontesta">No contesta</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="detalle" class="m-0 label-primary" style="font-size: 15px;">
                                    <i class="fa fa-info-circle"></i> Detalles del Último Contacto
                                </label>
                                <textarea class="form-control form-control-sm" id="detalle" name="detalle" rows="3" required></textarea>
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="oracion" class="m-0 label-primary" style="font-size: 15px;">
                                    <i class="fa fa-praying-hands"></i> Peticiones de Oración Específicas
                                </label>
                                <textarea class="form-control form-control-sm" id="oracion" name="oracion" rows="3" required></textarea>
                            </div>
                            <div class="form-group col-lg-12">
                                <!-- Botón de Envío -->
                                <button type="submit" class="btn btn-primary"
                                    style="background-color:#2ecc71; border-color:#2ecc71; color:#fff;">
                                    <i class="fa fa-user-plus"></i> Registrar Seguimiento
                                </button>
                                <!-- Botón de Cancelar (opcional) -->
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                                    <i class="fa fa-times"></i> Cerrar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="col-lg-12 col-md-12">
                            <div class="table-wrapper">
                                <table id="tableSeguimiento"
                                    class="display table table-bordered table-hover table-condensed">
                                    <thead>
                                        {{-- Contenido de JS --}}
                                    </thead>
                                    <tbody>
                                        {{-- Contenido de la tabla --}}
                                    </tbody>
                                    
                                </table>
                                <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                                    <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                                        <i class="fa fa-file"></i> Reporte de Seguimiento
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>


{{-- <script>
    // Define las variables en el contexto global de JavaScript
    var userProfileId = @json(Auth::guard('web')->user()->profile_id);
    var PERFIL_DESARROLLADOR = @json(\BolsaTrabajo\App::$PERFIL_DESARROLLADOR);
</script> --}}
<script type="text/javascript" src="{{ asset('auth/js/celula/_Seguimiento.js') }}"></script>
