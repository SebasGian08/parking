@extends('auth.index')

@section('titulo')
    <title>Horas Extras</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <style>
        .text-verde {
            color: #155724;
            /* Color del texto */
            background-color: #d4edda;
            /* Verde más brillante */
            padding: 5px 10px;
            /* Espaciado interno */
            border-radius: 20px;
            /* Bordes redondeados más pronunciados */
            font-size: 10px;
        }

        .text-naranja {
            color: #ff7700;
            background-color: #ffe8d2;
            padding: 5px 10px;
            /* Espaciado interno */
            border-radius: 20px;
            /* Bordes redondeados más pronunciados */
            font-size: 10px;
        }

        .text-rojo {
            color: #720202;
            background-color: #ffa9a973;
            padding: 5px 10px;
            /* Espaciado interno */
            border-radius: 20px;
            /* Bordes redondeados más pronunciados */
            font-size: 10px;
        }
    </style>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Horas Extras
                {{-- <small>Mantenimiento</small> --}}
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <button type="button" id="modalRegistrarExtras" class="btn-primary"><i class="fa fa-plus"></i>
                        Registrar Horas Extras</button>
                </li>
            </ol>
        </section>
        <br>
        <hr>
        {{-- <div class="content-header">
            <div class="form-row">
                <!-- Filtro Fecha Exacta -->
                <div class="form-group col-lg-3 col-md-6">
                    <label for="desde" class="m-0 label-primary">Desde</label>
                    <input type="date" class="form-control-m form-control-sm" id="desde" value="{{ Date('Y-m-d') }}">
                </div>
                <div class="form-group col-lg-3 col-md-6">
                    <label for="hasta" class="m-0 label-primary">Hasta</label>
                    <input type="date" class="form-control-m form-control-sm" id="hasta" value="{{ Date('Y-m-d') }}">
                </div>
                <div class="form-group col-lg-3 col-md-6">
                    <label for="dni" class="m-0 label-primary">Buscar por DNI</label>
                    <input type="text" class="form-control-m form-control-sm" id="dni" placeholder="Ingrese DNI">
                </div>
                <div class="form-group col-lg-2 col-md-6">
                    <label class="m-0 label-primary">&nbsp;</label>
                    <button class="btn-m btn-primary" id="btn-consultar">
                        <i class="fa fa-search"></i> Consultar
                    </button>
                </div>

            </div>
        </div> --}}
        <br>
        <section class="content-header">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <table id="tableExtras" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                    <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                        <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcel()">
                            <i class="fa fa-file"></i> Reporte
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/extras/index.js') }}"></script>
@endsection
