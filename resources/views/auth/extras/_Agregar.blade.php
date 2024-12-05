<div id="modalMantenimientoExtras" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.extras.store') }}" id="registroExtras" method="POST"
              data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
              data-ajax-success="OnSuccessRegistroExtras" data-ajax-failure="OnFailureRegistroExtras">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : 'Registrar' }} HORA EXTRA</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" class="form-control" id="dni" name="dni" value="{{ $Entity->dni ?? '' }}" required maxlength="11"
                        pattern="\d*" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        <span data-valmsg-for="dni" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="horas">Horas</label>
                        <input type="number" class="form-control" id="horas" name="horas" value="{{ $Entity->horas ?? 0 }}" required>
                    </div>

                    <div class="form-group">
                        <label for="minutos">Minutos</label>
                        <input type="number" class="form-control" id="minutos" name="minutos" value="{{ $Entity->minutos ?? 0 }}" required>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="created_at" name="created_at" value="{{ $Entity->created_at ?? '' }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">{{ $Entity != null ? 'Modificar' : 'Registrar' }} HORA EXTRA</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/extras/_Mantenimiento.js') }}"></script>
