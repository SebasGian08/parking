<div id="modalMantenimientoConfiguracion" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.configuracion.update') }}" id="registroConfiguracion"
            method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroConfiguracion" data-ajax-failure="OnFailureRegistroConfiguracion">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : ' Registrar' }} Estado</h5>
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
                                <label for="numero">Número (IP)</label>
                                <input type="text" class="form-input" name="numero"
                                    value="{{ $Entity ? $Entity->numero : '' }}" id="numero" autocomplete="off"
                                    required pattern="^(\d{1,3}\.){3}\d{1,3}$" title="Formato: xxx.xxx.xxx.xxx">
                                <span data-valmsg-for="numero" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="estado">Estado</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" name="estado" id="estado" required>
                                            <option value="0"
                                                {{ $Entity && $Entity->estado == '0' ? 'selected' : '' }}>Inactivo
                                            </option>
                                            <option value="1"
                                                {{ $Entity && $Entity->estado == '1' ? 'selected' : '' }}>Activo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.getElementById('numero').addEventListener('input', function() {
                        const ipPattern =
                            /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/;

                        if (!ipPattern.test(this.value)) {
                            this.setCustomValidity('Por favor, ingrese una dirección IP válida.');
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                </script>

                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : ' Registrar' }}
                        ESTADO
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/configuracion/_Mantenimiento.js') }}"></script>
