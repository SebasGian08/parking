<div id="modalMantenimientoVehiculos" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.vehiculos.store') }}" id="registroVehiculos"
            method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroVehiculos" data-ajax-failure="OnFailureRegistroVehiculos">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : 'Registrar' }} Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">

                    <!-- Placa -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="placa">Placa</label>
                                <input type="text" class="form-input" name="placa"
                                    value="{{ $Entity ? $Entity->placa : '' }}" id="placa" autocomplete="off"
                                    required>
                                <span data-valmsg-for="placa" class="text-danger"></span>
                            </div>

                            <!-- Tipo de Vehículo -->
                            <div class="col-md-12">
                                <label for="tipo_id">Tipo de Vehículo</label>
                                <select name="tipo_id" class="form-input" id="tipo_id" required>
                                    <option value="">-- Seleccione --</option>
                                    @foreach ($Tipos as $q)
                                        <option value="{{ $q->id }}"
                                            {{ $Entity && $Entity->tipo_id == $q->id ? 'selected' : '' }}>
                                            {{ $q->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <span data-valmsg-for="tipo_id" class="text-danger"></span>
                            </div>

                            <!-- Modelo -->
                            <div class="col-md-12">
                                <label for="modelo">Modelo</label>
                                <input type="text" class="form-input" name="modelo"
                                    value="{{ $Entity ? $Entity->modelo : '' }}" id="modelo" autocomplete="off">
                                <span data-valmsg-for="modelo" class="text-danger"></span>
                            </div>

                            <!-- Marca -->
                            <div class="col-md-12">
                                <label for="marca">Marca</label>
                                <input type="text" class="form-input" name="marca"
                                    value="{{ $Entity ? $Entity->marca : '' }}" id="marca" autocomplete="off">
                                <span data-valmsg-for="marca" class="text-danger"></span>
                            </div>

                            <!-- Color -->
                            <div class="col-md-12">
                                <label for="color">Color</label>
                                <input type="text" class="form-input" name="color"
                                    value="{{ $Entity ? $Entity->color : '' }}" id="color" autocomplete="off">
                                <span data-valmsg-for="color" class="text-danger"></span>
                            </div>

                            <!-- Observaciones -->
                            <div class="col-md-12">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-input" name="observaciones" id="observaciones" rows="3">{{ $Entity ? $Entity->observaciones : '' }}</textarea>
                                <span data-valmsg-for="observaciones" class="text-danger"></span>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-12">
                                <label for="estado">Estado</label>
                                <select class="form-input" name="estado" id="estado" required>
                                    <option value="1" {{ $Entity && $Entity->estado == 1 ? 'selected' : '' }}>
                                        Activo</option>
                                    <option value="2" {{ $Entity && $Entity->estado == 2 ? 'selected' : '' }}>
                                        Inactivo</option>
                                </select>
                                <span data-valmsg-for="estado" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">
                        {{ $Entity != null ? 'Modificar' : 'Registrar' }} Vehículo
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/vehiculos/_Mantenimiento.js') }}"></script>