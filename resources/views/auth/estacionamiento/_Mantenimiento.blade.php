<div id="modalMantenimientoEstablecimiento" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.estacionamiento.store') }}" id="registroEstablecimiento" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroEstablecimiento" data-ajax-failure="OnFailureRegistroEstablecimiento">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : ' Registrar' }} Establecimiento</h5>
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
                                <label for="codigo">Codigo</label>
                                <input type="text" class="form-input" name="codigo"
                                    value="{{ $Entity ? $Entity->codigo : '' }}" id="codigo" autocomplete="off"
                                    required>
                                <span data-valmsg-for="codigo" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="numero">Numero</label>
                                <input type="text" class="form-input" name="numero"
                                    value="{{ $Entity ? $Entity->numero : '' }}" id="numero" autocomplete="off"
                                    required>
                                <span data-valmsg-for="numero" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="piso">Piso</label>
                                <input type="text" class="form-input" name="piso"
                                    value="{{ $Entity ? $Entity->piso : '' }}" id="piso" autocomplete="off"
                                    required>
                                <span data-valmsg-for="piso" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones</label>
                                <input type="text" class="form-input" name="observaciones"
                                    value="{{ $Entity ? $Entity->observaciones : '' }}" id="observaciones" autocomplete="off"
                                    required>
                                <span data-valmsg-for="observaciones" class="text-danger"></span>
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
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : ' Registrar' }}
                        Establecimiento</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/estacionamiento/_Mantenimiento.js') }}"></script>
