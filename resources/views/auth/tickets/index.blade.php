@extends('auth.index')

@section('titulo')
    <title>Registro de Tickets</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado de Tickets
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <button type="button" id="modalRegistrarTickets" class="btn-primary"><i class="fa fa-plus"></i> Registrar
                        Ticket</button>
                </li>
            </ol>
        </section>
        <br>
        <hr>
        <style>
            .bloqueado {
                background-color: #ffe4ca85 !important;
                /* Color de fondo para indicar que la fila está bloqueada */
            }

            .bloqueado .btn {
                pointer-events: none !important;
                /* Deshabilitar los botones */
                opacity: 0.5 !important;
                /* Reducir la opacidad de los botones */
            }
        </style>
        <div class="content-header">
            <div class="form-row">
                <!-- Filtro Fecha Exacta -->
                <div class="form-group col-lg-3 col-md-6">
                    <label for="desde" class="m-0 label-primary">Desde :</label>
                    <input type="date" class="form-control-m form-control-sm" id="desde"
                        value="{{ Date('2020-m-d') }}">
                </div>
                <div class="form-group col-lg-3 col-md-6">
                    <label for="hasta" class="m-0 label-primary">Hasta :</label>
                    <input type="date" class="form-control-m form-control-sm" id="hasta" value="{{ Date('Y-m-d') }}">
                </div>
                <div class="form-group col-lg-3 col-md-6">
                    <label for="estado" class="m-0 label-primary">Estado :</label>
                    <select class="form-control-m form-control-sm" id="estado">
                        <option value="1">Activo</option>
                        <option value="2">Cerrado</option>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-6">
                    <label class="m-0 label-primary">&nbsp;</label>
                    <button class="btn-m btn-primary" id="btn-consultar">
                        <i class="fa fa-search"></i> Consultar
                    </button>
                </div>
            </div>
        </div>
        <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="content-header">
                        <table id="tableTickets"
                            class="table table-bordered table-striped display nowrap margin-top-10 dataTable no-footer">
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/tickets/index.js') }}"></script>
@endsection
