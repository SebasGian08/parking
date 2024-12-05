<div id="modalMantenimientoEmpresa" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-md">
        <form enctype="multipart/form-data" action="{{ route('auth.empresa.update_data') }}" id="registroEmpresa" method="POST"
              data-ajax="true" data-close-modal="true" data-ajax-loading="#loading" data-ajax-success="OnSuccessRegistroEmpresa" data-ajax-failure="OnFailureRegistroEmpresa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Datos de Empresa</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="id" value="{{ $Entity != null ? $Entity->id : "" }}" required>
                                <label for="">RUC</label>
                                <input type="text" class="form-input" name="ruc" value="{{ $Entity != null ? $Entity->ruc : "" }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Razón Social</label>
                                <input type="text" class="form-input" name="razon_social" value="{{ $Entity != null ? $Entity->razon_social : "" }}" autocomplete="off" >
                            </div>
                            <div class="col-md-4">
                                <label for="">Nombre Empresa</label>
                                <input type="text" class="form-input" name="nombre_empresa" value="{{ $Entity != null ? $Entity->nombre_comercial : "" }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Ciudad</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->provincias->nombre : "" }}" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="">Distrito</label>
                                <input type="text" class="form-input" value="{{ $Entity != null ? $Entity->distritos->nombre : "" }}" autocomplete="off" disabled>
                            </div>
                        </div>
                    </div> --}}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="">Dirección</label>
                                <input type="text" class="form-input" name="direccion" value="{{ $Entity != null ? $Entity->direccion : "" }}" autocomplete="off" required>
                            </div>
                            <div class="col-md-4">
                                <label for="">Teléfono</label>
                                <input type="text" class="form-input" name="telefono" value="{{ $Entity != null ? $Entity->telefono : "" }}" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Tipo de Persona</label>
                                @php
                                    if ($Entity->tipo_persona == 1) {
                                        $nTP = 'Persona Juridica';
                                    }else if($Entity->tipo_persona == 2){
                                        $nTP = 'Persona Natural';
                                    }else if($Entity->tipo_persona == 3){
                                        $nTP = 'Persona Natural con Empresa';
                                    }
                                @endphp
                                <select name="tipo_persona" id="" class="form-input" required>
                                    <option value="{{ $Entity != null ? $Entity->tipo_persona : "" }}" hidden selected>{{$nTP}}</option>
                                    <option value="1">Persona Juridica</option>
                                    <option value="2">Persona Natural</option>
                                    <option value="3">Persona Natural con Empresa</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">E-mail</label>
                                <input type="text" class="form-input" name="email" value="{{ $Entity != null ? $Entity->email : "" }}" autocomplete="off">
                            </div>
                            <div class="col-md-3">
                                <label for="">Página Web</label>
                                <input type="text" class="form-input" name="pagina_Web" value="{{ $Entity != null ? $Entity->	pagina_web : "" }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nombre Contacto</label>
                                <input type="text" class="form-input" name="nombre_contacto" value="{{ $Entity->nombre_contacto }}" autocomplete="off" >
                            </div>
                            <div class="col-md-4">
                                <label for="">Teléfono Contacto</label>
                                <input type="text" class="form-input" name="telefono_contacto" value="{{ $Entity != null ? $Entity->telefono_contacto : "" }}" autocomplete="off" >
                            </div>
                            <div class="col-md-4">
                                <label for="">Cargo Contacto</label>
                                <input type="text" class="form-input" name="cargo_contacto" value="{{ $Entity->cargo_contacto }}" autocomplete="off" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">E-mail Contacto</label>
                                <input type="email" class="form-input" name="email_contacto" value="{{ $Entity->email_contacto }}" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                {{-- <label for="">.asdasd</label> --}}
                                <button tyoe="submit" class="btn btn-primary w-100" style="margin-top:28px;">Guardar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('auth/js/empresa/_Editar.js') }}"></script>
