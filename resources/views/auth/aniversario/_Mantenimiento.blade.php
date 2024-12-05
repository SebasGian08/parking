<div id="modalMantenimientEdit" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="" id="registroEditAsistente"
            method="POST" data-ajax="true" data-close-modal="true"
            data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroEditAsistente"
            data-ajax-failure="OnFailureRegistroEditAsistente">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asistente</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity->id }}">
                    <div class="form-group">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="nombres" class="m-0 label-primary">Nombres y Apellidos</label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="nombres" id="nombres"
                                        value="{{ $Entity ? $Entity->nombre : '' }}" autocomplete="off" required disabled>
                                </div>
                            </div>
                        
                            <!-- Teléfono Field -->
                            <div class="form-group col-lg-6">
                                <label for="telefono" class="m-0 label-primary">Teléfono</label>
                                <div class="input-group">
                                    <input type="text" class="form-input" name="tel" id="tel"
                                        value="{{ $Entity ? $Entity->tel : '' }}" autocomplete="off" required disabled>
                                </div>
                            </div>
                        </div>
                        
                        @if ($Entity && $Entity->foto)
                            <div class="text-center mt-2">
                                <img src="{{ asset($Entity->foto) }}" alt="Foto" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                        <i class="fa fa-times"></i> Cerrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
