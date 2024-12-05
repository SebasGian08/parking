@extends('auth.index')

@section('titulo')
    <title>JAC | Listado de Actividades</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado de Actividades
                <small>| Mantenimiento</small>
            </h1>
        </section>
        <br>
        <div class="content-header">
            <div class="form-row">
                <!-- Filtro fecha_desde -->
                <div class="form-group col-lg-4 col-md-6">
                    <label>Fecha Desde:</label>
                    <input type="date" id="fecha_desde" class="form-control" />
                </div>
                <div class="form-group col-lg-4 col-md-6">
                    <label>Fecha Hasta:</label>
                    <input type="date" id="fecha_hasta" class="form-control" />
                </div>
                <!-- Botón de Consulta -->
                <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                    <label>&nbsp;</label>
                    <a href="javascript:void(0)" id="btn-consultar" class="btn-m btn-primary-m">
                        <i class="fa fa-search"></i> Consultar Actividad
                    </a>
                </div>
            </div>
        </div>
        <hr>
        <section class="content">
            @csrf
            <div class="row">
                <style>
                    #tableActividades tbody tr:hover {
                        cursor: pointer;
                        /* Cambia el cursor a una mano cuando se pasa sobre la fila */
                    }
                </style>
                <div class="col-md-12">
                    <div class="content-header">
                        <table id="tableActividades"
                            class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer">
                        </table>
                        <br>
                        <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                            <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                                <i class="fa fa-file"></i> Reporte de Actividades
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/calendario/index.js') }}"></script>
@endsection
