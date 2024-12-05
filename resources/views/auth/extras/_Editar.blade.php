<div id="modalMantenimientoExtras" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.extras.update') }}" id="registroExtras" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroExtras" data-ajax-failure="OnFailureRegistroExtras">
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
                                <label for="estado" class="font-weight-bold">Estado</label>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" name="estado" id="estado" required>
                                            <option value="0" {{ $Entity && $Entity->estado == '0' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="1" {{ $Entity && $Entity->estado == '1' ? 'selected' : '' }}>Aprobado</option>
                                            <option value="2" {{ $Entity && $Entity->estado == '2' ? 'selected' : '' }}>Rechazado</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="documentoDiv" style="display: none;">
                                    <label for="documento" class="font-weight-bold">Documento</label>
                                    <input type="file" class="form-control-file" id="documento" name="documento">
                                    @if($Entity && $Entity->documento)
                                        <p class="mt-2">
                                            <strong>Documento actual:</strong> 
                                            <a href="{{ asset($Entity->documento) }}" target="_blank" class="text-primary">
                                                {{ basename($Entity->documento) }}
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            <script>
                                document.getElementById('estado').addEventListener('change', function() {
                                    var documentoDiv = document.getElementById('documentoDiv');
                                    var documentoInput = document.getElementById('documento');
                                    if (this.value === '1') {
                                        documentoDiv.style.display = 'block'; // Mostrar el div
                                        documentoInput.setAttribute('required', 'required'); // Hacer el campo requerido
                                    } else {
                                        documentoDiv.style.display = 'none'; // Ocultar el div
                                        documentoInput.removeAttribute('required'); // Quitar el requerimiento
                                    }
                                });
                        
                                // Llama al evento de cambio para ajustar el estado inicial si es necesario
                                document.getElementById('estado').dispatchEvent(new Event('change'));
                            </script>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                        class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : ' Registrar' }} ESTADO
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/extras/_Mantenimiento.js') }}"></script>
