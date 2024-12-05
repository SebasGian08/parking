<div id="modalMantenimientoPrograma" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" action="{{ route('auth.programa.updateData') }}" id="registroPrograma"
            method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroPrograma" data-ajax-failure="OnFailureRegistroPrograma">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Datos del Programa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                    <label for="registro" class="m-0 label-primary">Fecha</label>
                                    <input type="date" class="form-control form-control-sm" id="registro"
                                        name="registro" value="{{ $Entity != null ? $Entity->registro : '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="{{ $Entity != null ? $Entity->id : '' }}"
                                    required>
                                <label for="">Empresa</label>
                                <input type="text" class="form-input" name="empresa"
                                    value="{{ $Entity != null ? $Entity->empresa : '' }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Programa</label>
                                <select name="tipo_programa" id="tipo_programa" class="form-input" required>
                                    <option value="" hidden>-- Seleccione --</option>
                                    <option value="Feria laboral"
                                        {{ old('tipo_programa', isset($Entity) ? $Entity->tipo_programa : '') == 'Feria laboral' ? 'selected' : '' }}>
                                        Feria laboral</option>
                                    <option value="Talent Day"
                                        {{ old('tipo_programa', isset($Entity) ? $Entity->tipo_programa : '') == 'Talent Day' ? 'selected' : '' }}>
                                        Talent Day</option>
                                    <option value="Nexo Laboral"
                                        {{ old('tipo_programa', isset($Entity) ? $Entity->tipo_programa : '') == 'Nexo Laboral' ? 'selected' : '' }}>
                                        Nexo Laboral</option>
                                    <option value="Contrata Talento"
                                        {{ old('tipo_programa', isset($Entity) ? $Entity->tipo_programa : '') == 'Contrata Talento' ? 'selected' : '' }}>
                                        Contrata Talento</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="">Puesto 1</label>
                                <input type="text" class="form-input" name="puestouno"
                                    value="{{ $Entity != null ? $Entity->puestouno : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Puesto 2</label>
                                <input type="text" class="form-input" name="puestodos"
                                    value="{{ $Entity != null ? $Entity->puestodos : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Puesto 3</label>
                                <input type="text" class="form-input" name="puestotres"
                                    value="{{ $Entity != null ? $Entity->puestotres : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Puesto 4</label>
                                <input type="text" class="form-input" name="puestocuatro"
                                    value="{{ $Entity != null ? $Entity->puestocuatro : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Responsable</label>
                                <select name="responsable" id="responsable" class="form-input" required>
                                    <option value="" hidden>-- Seleccione --</option>
                                    <option value="Bryan Julcamoro"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Bryan Julcamoro' ? 'selected' : '' }}>
                                        Bryan Julcamoro</option>
                                    <option value="Joselyn Condori"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Joselyn Condori' ? 'selected' : '' }}>
                                        Joselyn Condori</option>
                                    {{-- <option value="Setafani Carlos"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Setafani Carlos' ? 'selected' : '' }}>
                                        Setafani Carlos</option> --}}
                                    <option value="Stefany Gutierrez"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Stefany Gutierrez' ? 'selected' : '' }}>
                                        Stefany Gutierrez</option>
                                    {{-- <option value="Yessica Caceres"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Yessica Caceres' ? 'selected' : '' }}>
                                        Yessica Caceres</option> --}}
                                    <option value="Yamile Bazan"
                                        {{ old('responsable', isset($Entity) ? $Entity->responsable : '') == 'Yamile Bazan"' ? 'selected' : '' }}>
                                        Yamile Bazan"</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button tyoe="submit" class="btn btn-primary" style="margin-top:28px;border-color:#2ecc71!important;">Actualizar Programa</button>
                            </div>
                            {{-- <div class="col-md-4">
                                <label for="">Cantidad Postulantes</label>
                                <input type="number" class="form-input" name="postulantes"
                                    value="{{ $Entity != null ? $Entity->postulantes : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Cantidad Evaluando</label>
                                <input type="number" class="form-input" name="evaluando"
                                    value="{{ $Entity != null ? $Entity->evaluando : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Cantidad Contratados</label>
                                <input type="number" class="form-input" name="contratados"
                                    value="{{ $Entity != null ? $Entity->contratados : '' }}" autocomplete="off">
                            </div>
                            <div class="col-md-4">
                                <label for="">Cantidad Descartados</label>
                                <input type="number" class="form-input" name="descartado"
                                    value="{{ $Entity != null ? $Entity->descartado : '' }}" autocomplete="off">
                            </div> --}}

                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="form-group">
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <button tyoe="submit" class="btn btn-primary" style="margin-top:28px;border-color:#2ecc71!important;">Actualizar Programa</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                  

                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/programa/_Editar.js') }}"></script>
