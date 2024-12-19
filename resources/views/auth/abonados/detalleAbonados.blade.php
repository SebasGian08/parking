@extends('auth.index')

@section('titulo')
    <title>Detalle Abonado</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <style>
        .activo {
            background-color: green;
            color: white;
        }

        .inactivo {
            background-color: red;
            color: white;
        }
    </style>
    <div class="content-wrapper">


        <br>
        <div class="content-header">

            <div class="container">
                <div class="row align-items-center">
                    <!-- Contenedor para los mensajes -->
                    <div class="col-lg-12">
                        <!-- Mensaje de éxito -->
                        @if (session('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fa fa-check-circle me-2"></i> <!-- Icono de éxito -->
                                <div>
                                    <ul class="mb-0">
                                        {{ session('success') }}
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <!-- Mensaje de error -->
                        @if ($errors->any())
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="fa fa-exclamation-triangle me-2"></i> <!-- Icono de error -->
                                <div>
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- Pestañas de navegación -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="empresa-tab" data-toggle="tab" href="#empresa" role="tab"
                            aria-controls="empresa" aria-selected="true">Datos Generales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contrato-tab" data-toggle="tab" href="#contrato" role="tab"
                            aria-controls="contrato" aria-selected="false">Contrato</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="listado-contrato-tab" data-toggle="tab" href="#listado-contrato"
                            role="tab" aria-controls="listado-contrato" aria-selected="false">Listado de Contratos</a>
                    </li>
                </ul>

                <!-- Contenido de las pestañas -->
                <div class="tab-content" id="myTabContent">
                    <!-- Formulario Datos Generales -->
                    <div class="tab-pane fade show active" id="empresa" role="tabpanel" aria-labelledby="empresa-tab">
                        <form action="{{ route('auth.abonados.update') }}" method="post" enctype="multipart/form-data"
                            style="margin-top: 20px;">
                            @csrf
                            <input type="hidden" id="id" name="id"
                                value="{{ $Entity != null ? $Entity->id : 0 }}">

                            <!-- Campos de Datos Generales -->
                            <div class="form-group">
                                <label for="tipo_doc">Tipo de Documento <span class="text-danger">*</span></label>
                                <select class="form-control" id="tipo_doc" name="tipo_doc" required>
                                    @foreach ($Tipo as $tipo)
                                        <option value="{{ $tipo->id }}"
                                            {{ $Entity->tipo_doc == $tipo->id ? 'selected' : '' }}>
                                            {{ $tipo->Nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="num_doc">Número de Documento <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="num_doc" name="num_doc"
                                    value="{{ old('num_doc', $Entity->num_doc ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="razon_social">RAZÓN SOCIAL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social"
                                    value="{{ old('razon_social', $Entity->razon_social ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    value="{{ old('direccion', $Entity->direccion ?? '') }}">
                            </div>

                            <div class="form-group">
                                <label for="tel">Teléfono</label>
                                <input type="text" class="form-control" id="tel" name="tel"
                                    value="{{ old('tel', $Entity->tel ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', $Entity->email ?? '') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" required>{{ old('observaciones', $Entity->observaciones ?? '') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select class="form-control" id="estado" name="estado" required>
                                    <option value="1" {{ $Entity->estado == 1 ? 'selected' : '' }}>Activo</option>
                                    <option value="2" {{ $Entity->estado == 2 ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Editar Datos Generales</button>
                        </form>
                    </div>
                    <!-- Formulario Contrato -->
                    <div class="tab-pane fade" id="contrato" role="tabpanel" aria-labelledby="contrato-tab">

                        <form method="post" action="{{ route('auth.abonados.storeContrato') }}"
                            enctype="multipart/form-data" style="margin-top: 20px;">
                            @csrf
                            <div class="container"
                                style="border: 2px solid #dee2e6; padding: 20px; border-radius: 10px; background-color: #f9f9f9;">
                                <!-- Título de Contrato -->
                                <div class="row">
                                    <!-- Información de la Empresa -->
                                    <input type="hidden" id="abonado_id" name="abonado_id"
                                        value="{{ $Entity != null ? $Entity->id : 0 }}">
                                    {{-- <div class="col-md-1">
                                        @if ($empresa && $empresa->logo)
                                            <a href="{{ route('auth.inicio') }}" class="logo">
                                                <span class="logo-m">
                                                    <img src="{{ asset($empresa->logo) }}" alt="Logo de la Empresa"
                                                        class="light-logo" style="max-width: 100px; max-height: 150px;">
                                                </span>
                                            </a>
                                        @endif
                                    </div> --}}
                                    <div class="col-md-7 text-left mb-4">
                                        <h2>{{ isset($empresa) && $empresa ? $empresa->nombre : 'Empresa no disponible' }}
                                        </h2>
                                        <p><strong>{{ isset($empresa) && $empresa ? $empresa->direccion : 'Dirección no disponible' }}</strong>
                                        </p>
                                    </div>

                                    <!-- Fechas en 2 columnas -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_inicio">Fecha de Inicio <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="fecha_inicio"
                                                name="fecha_inicio" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fecha_fin">Fecha de Fin <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin"
                                                required>
                                        </div>
                                    </div>

                                </div>
                                <!-- Información adicional del contrato -->
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="estacionamiento">Estacionamiento <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="estacionamiento_id"
                                                name="estacionamiento_id" required>
                                                <option value="">Seleccione un estacionamiento</option>
                                                @foreach ($Estacionamientos as $estacionamiento)
                                                    <option value="{{ $estacionamiento->id }}">
                                                        {{ $estacionamiento->numero }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="vehiculo">Vehículo <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <!-- Input para buscar placas -->
                                            <input autocomplete="off" type="text" class="form-control form-control-sm"
                                                id="vehiculo_id" name="vehiculo_id" placeholder="Ingresar placa"
                                                list="listaPlacas" value="{{ isset($vehiculo) ? $vehiculo->id : '' }}"
                                                required>
                                        </div>
                                        <datalist id="listaPlacas">
                                            <!-- Las opciones dinámicas se añadirán aquí -->
                                        </datalist>
                                        <div class="invalid-feedback">
                                            Por favor ingresa una placa válida.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="plan_servicio">Plan de Servicio <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="plan_id" name="plan_id" required>
                                                <option value="">Seleccione un plan de servicio</option>
                                                <!-- Aquí se generan dinámicamente los planes -->
                                                @foreach ($Planes as $plan)
                                                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="nota">Nota <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="nota" name="nota" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-4 py-2"
                                            style="font-size: 14px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                                            <strong>Generar Contrato</strong>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <!-- Listado de Contratos -->
                    <div class="tab-pane fade" id="listado-contrato" role="tabpanel"
                        aria-labelledby="listado-contrato-tab">
                        <!-- Aquí se muestra un listado de contratos -->
                        <section class="content">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <div class="content-header">
                                        <table id="tableContratos"
                                            class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/abonados/index.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Llamada AJAX para obtener las placas cuando se escribe en el campo
            $('#vehiculo_id').on('input', function() {
                var placa = $(this).val(); // Obtiene el valor del campo de placa

                if (placa.length >= 1) { // Inicia la búsqueda si se escribe al menos 3 caracteres
                    $.ajax({
                        url: '/auth/tickets/listarPlacasMasFrecuentes', // URL correcta
                        method: 'GET',
                        data: {
                            placa: placa
                        }, // Envía el valor de la placa como parámetro
                        success: function(data) {
                            const datalist = $('#listaPlacas'); // Referencia al datalist
                            datalist.empty(); // Limpia las opciones anteriores

                            // Recorre los resultados y añade las opciones al datalist
                            data.forEach(function(item) {
                                datalist.append(
                                    `<option value="${item.placa}">${item.placa} (${item.cantidad} tickets)</option>`
                                );
                            });
                        },
                        error: function(error) {
                            console.error('Error al cargar las placas:', error);
                        }
                    });
                }
            });
        });


        /* tabla contratos */
        var $dataTableContratos, $dataTable;
        $(function() {
            const $table = $("#tableContratos");

            $dataTableContratos = $table.DataTable({
                stripeClasses: ["odd-row", "even-row"],
                lengthChange: true,
                lengthMenu: [
                    [50, 100, 200, 500, -1],
                    [50, 100, 200, 500, "Todo"],
                ],
                info: false,
                buttons: [],
                ajax: {
                    url: "/auth/abonados/list_allContratos",
                    dataSrc: 'data', // Indica que los datos están bajo el campo "data"
                },
                columns: [{
                        title: "ID",
                        data: "id",
                        className: "text-center",
                        render: function(data) {
                            return 'C-' + String(data).padStart(5,
                                '0'); // Formatea el id con el prefijo 'C-' y 5 dígitos
                        }
                    },
                    {
                        title: "Razon Social", // Abonado
                        data: "abonado.razon_social",
                    },
                    {
                        title: "Placa", // Vehículo
                        data: "vehiculo_id",
                    },
                    {
                        title: "Estacionamiento", // Estacionamiento
                        data: "estacionamiento.codigo",
                    },
                    {
                        title: "Plan", // Plan
                        data: "plan.nombre",
                    },
                    {
                        title: "Fecha de Inicio", // Plan - fecha_inicio
                        data: "fecha_inicio",
                    },
                    {
                        title: "Fecha de Fin", // Plan - fecha_fin
                        data: "fecha_fin",
                    },
                    {
                        title: "Estado",
                        data: "estado",
                        render: function(data) {
                            return data === 1 || data === "1" ?
                                "<span class='estado-activo'>Activo</span>" :
                                "<span class='estado-inactivo'>Inactivo</span>";
                        },
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return (
                                "<div class='btn-group' role='group'>" +
                                "<a href='/auth/abonados/partialViewDetalle/" +
                                row.id +
                                "' class='btn btn-info btn-lg' data-toggle='tooltip' title='Ver Detalle'>" +
                                "<i class='fa fa-eye'></i>" +
                                "</a>" +
                                "<button type='button' class='btn btn-danger btn-lg btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>" +
                                "</div>"
                            );
                        },
                        orderable: false,
                        searchable: false,
                        width: "150px",
                    },

                ],
            });


            $table.on("click", ".btn-update", function() {
                const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
                invocarModalView(id);
            });

            $table.on("click", ".btn-delete", function() {
                const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
                const formData = new FormData();
                formData.append("_token", $("input[name=_token]").val());
                formData.append("id", id);
                confirmAjax(
                    `/auth/abonados/delete`,
                    formData,
                    "POST",
                    null,
                    null,
                    function() {
                        $dataTableAbonados.ajax.reload(null, false);
                    }
                );
            });

            $("#modalRegistrarArea").on("click", function() {
                invocarModalView();
            });

            function invocarModalView(id) {
                invocarModal(
                    `/auth/abonados/partialView/${id ? id : 0}`,
                    function($modal) {
                        if ($modal.attr("data-reload") === "true")
                            $dataTableAbonados.ajax.reload(null, false);
                    }
                );
            }

            $table.on("click", ".btn-view", function() {
                const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
                invocarModalViewDetalle(id);
            });

            function invocarModalViewDetalle(id) {
                invocarModal(
                    `/auth/abonados/partialViewDetalle/${id ? id : 0}`,
                    function($modal) {
                        if ($modal.attr("data-reload") === "true")
                            $dataTableAbonados.ajax.reload(null, false);
                    }
                );
            }
        });
    </script>
@endsection
