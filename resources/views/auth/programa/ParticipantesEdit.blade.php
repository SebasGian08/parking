<div id="modalMantenimientEdit" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg" style="width: 30% !important;">
        <form enctype="multipart/form-data" 
              action="{{ route('auth.programa.updateParticipanteInscrito') }}"
              id="registroEdit" 
              method="POST"
              data-ajax="true" 
              data-close-modal="true" 
              data-ajax-loading="#loading"
              data-ajax-success="OnSuccessRegistroEdit" 
              data-ajax-failure="OnFailureRegistroEdit">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $Entity != null ? 'Modificar' : 'Registrar' }} Participante
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    
                    <div class="form-group">
                        <div class="row">
                            <!-- DNI Field -->
                            <div class="form-group col-lg-12">
                                <label for="dniedit" class="m-0 label-primary">
                                    DNI <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="hidden" name="id" value="{{ $Entity != null ? $Entity->id_participante : '' }}"
                                    required>
                                    <input autocomplete="off" 
                                           type="text" 
                                           class="form-control form-control-sm" 
                                           id="dniedit" 
                                           name="dniedit"
                                           value="{{ $Entity ? $Entity->dni : '' }}" 
                                           placeholder="Ingresar DNI" 
                                           minlength="1" 
                                           readonly required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" 
                                                id="buscardniespecialidad" 
                                                type="button" 
                                                style="background-color: #0072bf; color: white;">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Por favor ingresa un DNI válido (entre 1 y 8 dígitos).
                                </div>
                            </div>
                            
                            <!-- Especialidad Field -->
                            <div class="form-group col-lg-6">
                                <label for="especialidadedit" class="m-0 label-primary">
                                    Especialidad <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-input" 
                                           name="especialidadEdit"
                                           id="especialidadEdit"
                                           value="{{ $Entity ? $Entity->especialidad : '' }}" 
                                           autocomplete="off" 
                                           readonly required>
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="especialidadedit" class="m-0 label-primary">
                                    Telefono <b style="color:red;font-size:10px"></b>
                                </label>
                                <div class="input-group">
                                    <input type="text" 
                                           class="form-input" 
                                           name="telefonoEdit"
                                           id="telefonoEdit"
                                           value="{{ $Entity ? $Entity->tel : '' }}" 
                                           autocomplete="off" 
                                           required>
                                </div>
                            </div>
                            <div class="form-group col-lg-12">
                                <label for="correo" class="m-0 label-primary">Correo Electrónico</label>
                                <input autocomplete="off" type="email" class="form-control form-control-sm"
                                value="{{ $Entity ? $Entity->email : '' }}"  id="email" name="email" placeholder="Correo Electrónico">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" 
                            class="btn btn-bold btn-pure btn-primary">
                        {{ $Entity != null ? 'Modificar' : 'Registrar' }} Participante
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


    
    
<script type="text/javascript" src="{{ asset('auth/js/programa/_ParticipantesEdit.js') }}"></script>
