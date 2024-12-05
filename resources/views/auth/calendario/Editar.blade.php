<div id="modalMantenimientoCalendario" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.calendario.update') }}" id="registroCalendario" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroCalendario" data-ajax-failure="OnFailureRegistroCalendario">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity ? 'Modificar' : 'Registrar' }} Actividad</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity ? $Entity->id : '' }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombre">Nombres de Actividad</label>
                                <input type="text" class="form-input" name="nombre"
                                    value="{{ $Entity ? $Entity->nombre : '' }}" id="nombre" autocomplete="off"
                                    required>
                                <span data-valmsg-for="nombre" class="text-danger"></span>
                            </div>
                            <!-- Fecha de Registro Field -->
                            <div class="col-md-12">
                                <label for="fecha_registro">Fecha de Registro
                                </label>
                                <div class="input-group">
                                    <input type="date" class="form-input" name="fecha_registro" id="fecha_registro"
                                        value="{{ $Entity ? $Entity->fecha_registro : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="tema">Tema</label>
                                <input type="text" class="form-input" name="tema"
                                    value="{{ $Entity ? $Entity->tema : '' }}" id="tema" autocomplete="off"
                                    required>
                                <span data-valmsg-for="nombres" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="libro">Libro</label>
                                <input type="text" class="form-input" name="libro"
                                    value="{{ $Entity ? $Entity->libro : '' }}" id="libro" autocomplete="off"
                                    required>
                                <span data-valmsg-for="libro" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="responsable">Responsable</label>
                                <input type="text" class="form-input" name="responsable"
                                    value="{{ $Entity ? $Entity->responsable : '' }}" id="responsable" autocomplete="off"
                                    required>
                                <span data-valmsg-for="responsable" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="estado">
                                    Estado
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity ? 'Modificar' : 'Registrar' }}
                        Actividad</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/calendario/_Mantenimiento.js') }}"></script>
