<div id="modalMantenimientoAsistntes" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" {{-- action="{{ route('auth.programa.storeParticipantes') }}" --}}
            id="registroAsistentes" method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroAsistentes" data-ajax-failure="OnFailureRegistroAsistentes">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Asistentes de {{ $Entity->nombre }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <input type="hidden" name="celula_id" class="celula_id" value="{{ $Entity->id }}" required>
                <div class="modal-body">
                    <div>
                        <div class="col-lg-12 col-md-12">
                            <div class="table-wrapper">
                                <table id="tableAsistentes"
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



<script type="text/javascript" src="{{ asset('auth/js/celula/_Asistentes.js') }}"></script>
