<div id="modalMantenimientoCelulas" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.celula.update') }}" id="registroCelulas" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroCelulas" data-ajax-failure="OnFailureRegistroCelulas">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : ' Registrar' }} Celula</h5>
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
                                <label for="lider_id">Líder de Célula</label>
                                <select class="form-control form-control-lg" id="lider_id" name="lider_id" required>
                                    <option value="" disabled>Select Líder..</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" 
                                            {{ $Entity && $Entity->lider_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->nombres }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <label for="nombre">Nombre de Célula</label>
                                <input type="text" class="form-input form-control-lg" name="nombre"
                                    value="{{ $Entity ? $Entity->nombre : '' }}" id="nombre" autocomplete="off">
                                <span data-valmsg-for="nombre" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-input form-control-lg" name="descripcion"
                                    value="{{ $Entity ? $Entity->descripcion : '' }}" id="descripcion" autocomplete="off">
                                <span data-valmsg-for="descripcion" class="text-danger"></span>
                            </div>
                            <div class="col-md-12">
                                <label for="estado">
                                    Estado
                                </label>
                                <div class="input-group">
                                    <select class="form-input form-control-lg" name="estado" id="estado" required>
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
                        class="btn btn-bold btn-pure btn-primary"><i class="fa fa-edit"></i> {{ $Entity != null ? 'Modificar' : ' Registrar' }}
                        Celula</button>
                        <!-- Botón de Cancelar (opcional) -->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                    <i class="fa fa-times"></i> Cancelar
                </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" src="{{ asset('auth/js/celula/_Mantenimiento.js') }}"></script>
