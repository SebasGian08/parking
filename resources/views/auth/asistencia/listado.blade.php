@extends('auth.index')

@section('titulo')
    <title>Grupo Codware | Listado de Asistencia</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <style>
        .estado.presente {
            background-color: #2ecc71;
            /* Fondo verde para presente */
            color: white;
            /* Texto blanco */
            border-radius: 5px;
            /* Bordes redondeados */
            padding: 2px 5px;
            /* Espaciado interno */
        }

        .estado.ausente {
            background-color: #ff4961;
            /* Fondo rojo para ausente */
            color: white;
            /* Texto blanco */
            border-radius: 5px;
            /* Bordes redondeados */
            padding: 2px 5px;
            /* Espaciado interno */
        }

        .estado.justificado {
            background-color: orange;
            /* Fondo naranja para justificado */
            color: white;
            /* Texto blanco */
            border-radius: 5px;
            /* Bordes redondeados */
            padding: 2px 5px;
            /* Espaciado interno */
        }
    </style>
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado de Asistencia
                {{-- <small>Mantenimiento</small> --}}
            </h1>
        </section>

        <br>
        <div class="content-header">
            <div class="form-row">
                <!-- Filtro Fecha Exacta -->
                <div class="form-group col-lg-4 col-md-6">
                    <label for="fecha_exacta" class="m-0 label-primary">Fecha Exacta de Programa</label>
                    <input type="date" class="form-control-m form-control-lg" id="fecha_exacta">
                </div>

                <!-- Filtro Estado de Asistencia -->
                <div class="form-group col-lg-4 col-md-6">
                    <label for="estado_asistencia" class="m-0 label-primary">Estado de Asistencia</label>
                    <select name="estado_asistencia" id="estado_asistencia" class="form-control-m form-control-lg">
                        <option value="" selected>-- Seleccione --</option>
                        <option value="presente">PRESENTE</option>
                        <option value="ausente">AUSENTE</option>
                        <option value="justificado">JUSTIFICADO</option>
                    </select>
                </div>

                <!-- Filtro Celula -->
                <div class="form-group col-lg-4 col-md-6">
                    <label for="celula_filter_id" class="m-0 label-primary">Celula</label>
                    <select name="celula_filter_id" id="celula_filter_id" class="form-control-m form-control-lg">
                        <option value="" selected>-- Seleccione --</option>
                        @foreach ($celulas as $celula)
                            <option value="{{ $celula->id }}">{{ $celula->nombre }}</option>
                        @endforeach
                    </select>
                    </select>
                </div>
                <!-- Botón de Consulta -->
                <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                    <a href="javascript:void(0)" id="btn-consultar" class="btn-m btn-primary-m">
                        <i class="fa fa-search"></i> Consultar Asistencia por Filtro
                    </a>
                </div>
            </div>
        </div>


        <hr>
        <section class="content-header">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <table id="tableAsistencia" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                    <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                        <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                            <i class="fa fa-file"></i> Reporte de asistencia
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/asistencia/index.js') }}"></script>
@endsection
