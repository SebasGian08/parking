<div id="modalMantenimientoTipo" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.tipo.store') }}" id="registroTipo" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroTipo" data-ajax-failure="OnFailureRegistroTipo">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : 'Registrar' }} Tipo</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-input" name="nombre"
                                    value="{{ $Entity ? $Entity->nombre : '' }}" id="nombre" autocomplete="off"
                                    required>
                                <span data-valmsg-for="nombre" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="montoxhora">Monto por Hora</label>
                                <input type="text" class="form-input" name="montoxhora"
                                    value="{{ $Entity ? $Entity->montoxhora : '' }}" id="montoxhora" autocomplete="off"
                                    required>
                                <span data-valmsg-for="montoxhora" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="montoxfraccion">Monto por Fracción</label>
                                <input type="text" class="form-input" name="montoxfraccion"
                                    value="{{ $Entity ? $Entity->montoxfraccion : '' }}" id="montoxfraccion" autocomplete="off"
                                    required>
                                <span data-valmsg-for="montoxfraccion" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-input" name="descripcion" id="descripcion" autocomplete="off"
                                    required>{{ $Entity ? $Entity->descripcion : '' }}</textarea>
                                <span data-valmsg-for="descripcion" class="text-danger"></span>
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
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : 'Registrar' }}
                        Tipo</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/tipo/_Mantenimiento.js') }}"></script>
