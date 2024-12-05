<div id="modalMantenimientoAsistencia" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.asistencia.storeAsistencia') }}" id="registroAsistencia" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroAsistencia" data-ajax-failure="OnFailureRegistroAsistencia">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : ' Registrar' }} Asistencia</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
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
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-input" name="created_at"
                                    value="{{ $Entity ? $Entity->fecha : '' }}" id="created_at" required>
                                <span data-valmsg-for="fecha" class="text-danger"></span>
                            </div>

                            <div class="col-md-12">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-input" name="dni"
                                    value="{{ $Entity ? $Entity->dni : '' }}" id="dni" autocomplete="off"
                                    required maxlength="11" pattern="\d*"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                <span data-valmsg-for="dni" class="text-danger"></span>
                            </div>

                            <div class="col-md-12">
                                <label for="hora_entrada">Hora de Entrada</label>
                                <input type="time" class="form-input" name="hora_entrada"
                                    value="{{ $Entity ? $Entity->hora_entrada : '' }}" id="hora_entrada" required>
                                <span data-valmsg-for="hora_entrada" class="text-danger"></span>
                            </div>

                            <div class="col-md-12">
                                <label for="hora_salida">Hora de Salida</label>
                                <input type="time" class="form-input" name="hora_salida"
                                    value="{{ $Entity ? $Entity->hora_salida : '' }}" id="hora_salida" required>
                                <span data-valmsg-for="hora_salida" class="text-danger"></span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : ' Registrar' }}
                        Asistencia</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/asistencia/_Mantenimiento.js') }}"></script>
