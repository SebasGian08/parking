<div id="modalMantenimientoEmpleado" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.empleado.update') }}" id="registroEmpleado"
            method="POST" data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroEmpleado" data-ajax-failure="OnFailureRegistroEmpleado">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $Entity != null ? 'Modificar' : 'Registrar' }} Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    <div class="row">
                        <div class="form-group col-lg-6" style="margin-bottom: 0;">
                            <label for="dni" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-id-card"></i> DNI
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="dni"
                                name="dni" placeholder="Ingrese DNI" value="{{ $Entity ? $Entity->dni : '' }}"
                                required maxlength="11" pattern="\d*"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <script>
                            document.getElementById('dni').addEventListener('input', function(e) {
                                this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                            });
                        </script>
                        <div class="form-group col-lg-6">
                            <label for="nombre" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Nombre
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="nombre"
                                name="nombre" placeholder="Ingrese nombre" value="{{ $Entity ? $Entity->nombre : '' }}"
                                required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="apellido" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-user"></i> Apellido
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="apellido"
                                name="apellido" placeholder="Ingrese apellido"
                                value="{{ $Entity ? $Entity->apellido : '' }}" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="cargo_id" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-briefcase"></i> Cargo
                            </label>
                            <select class="form-control form-control-lg" id="cargo_id" name="cargo_id" required>
                                <option value="" disabled {{ $Entity ? '' : 'selected' }}>Seleccione cargo
                                </option>
                                @foreach ($cargo as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $Entity && $Entity->cargo_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6" style="margin-bottom: 0;">
                            <label for="tel" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-phone"></i> Teléfono
                            </label>
                            <input autocomplete="off" type="tel" class="form-control form-control-lg" id="tel"
                                name="tel" placeholder="Ingrese teléfono" value="{{ $Entity ? $Entity->tel : '' }}"
                                required maxlength="9" pattern="\d{9}"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>

                        <script>
                            document.getElementById('tel').addEventListener('input', function(e) {
                                this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                            });
                        </script>


                        <div class="form-group col-md-6">
                            <label for="estado" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Estado
                            </label>
                            <div class="input-group">
                                <select class="form-control form-control-lg" name="estado" id="estado" required>
                                    <option value="1" {{ $Entity && $Entity->estado == '1' ? 'selected' : '' }}>
                                        Activo
                                    </option>
                                    <option value="2" {{ $Entity && $Entity->estado == '2' ? 'selected' : '' }}>
                                        Inactivo
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="email" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-envelope"></i> Email
                            </label>
                            <input autocomplete="off" type="email" class="form-control form-control-lg"
                                id="email" name="email" placeholder="Ingrese email"
                                value="{{ $Entity ? $Entity->email : '' }}" required>
                        </div>

                        <div class="form-group col-lg-6">
                            <label for="horario_id" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-briefcase"></i> Horario
                            </label>
                            <select class="form-control form-control-lg" id="horario_id" name="horario_id" required>
                                <option value="" disabled {{ $Entity ? '' : 'selected' }}>Seleccione Horario
                                </option>
                                @foreach ($horarios as $item)
                                    <!-- Cambiado a 'horarios' -->
                                    <option value="{{ $item->id }}"
                                        {{ $Entity && $Entity->horario_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->ingreso }} - {{ $item->salida }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-user-circle"></i> Seleccione un Avatar
                            </label>
                            <div class="avatar-selection">
                                <div class="row">
                                    @foreach ($avatars as $avatar)
                                        <div class="col-md-3">
                                            <div class="checkbox-wrapper-4">
                                                <input class="inp-cbx" id="avatar-{{ $avatar->id }}"
                                                    type="radio" name="avatar_id" value="{{ $avatar->id }}"
                                                    @if ($Entity->avatar_id == $avatar->id) checked @endif />
                                                <label class="cbx" for="avatar-{{ $avatar->id }}">
                                                </label>
                                                <div class="avatar-container">
                                                    <img src="{{ asset($avatar->file_name) }}"
                                                        alt="{{ $avatar->name }}" class="img-thumbnail"
                                                        style="max-width: 100px; display: block; margin: 10px auto;">
                                                </div>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewBox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <style>
                            .checkbox-wrapper-4 {
                                display: flex;
                                align-items: center;
                                margin-bottom: 10px;
                            }

                            .checkbox-wrapper-4 .avatar-container {
                                flex-grow: 1;
                            }

                            .checkbox-wrapper-4 .cbx {
                                margin-right: 10px;
                            }

                            .checkbox-wrapper-4 .cbx {
                                display: flex;
                                align-items: center;
                            }
                        </style>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary">
                        <i class="fa fa-edit"></i> {{ $Entity != null ? 'Modificar' : 'Registrar' }} Empleado
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background-color:#e74c3c; border-color:#e74c3c; color:#fff;">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/empleado/_Mantenimiento.js') }}"></script>
