@extends('auth.index')

@section('titulo')
    <title>JAC | Registro de Celula</title>
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

        <section class="content-header">
            <h1>
                Gestión de celulas
            </h1>
        </section>

        <br>
        <div class="content-header">
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
            <div class="form-row">
                <form class="col-lg-12 col-md-12" action="{{ route('auth.celula.store') }}" method="post">
                    @csrf
                    <div style="display: flex; flex-wrap: wrap;">
                        <div class="form-group col-lg-6">
                            <label for="liderid" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-tag"></i> Líder de Célula
                            </label>
                            <select class="form-control form-control-lg" id="lider_id" name="lider_id" required>
                                <option value="" disabled selected>Seleccione Líder..</option>
                                @foreach ($user as $user)
                                    <option value="{{ $user->id }}">{{ $user->nombres }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="nombre" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Nombre de Célula
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="nombre"
                                name="nombre" placeholder="Ingrese nombre de célula" required>
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="descripcion" class="m-0 label-primary" style="font-size: 15px;">
                                <i class="fa fa-check"></i> Descripción <span
                                    style="color:#2ecc71;font-size:12px;">(opcional)</span>
                            </label>
                            <input autocomplete="off" type="text" class="form-control form-control-lg" id="descripcion"
                                name="descripcion" placeholder="Ingrese Descripción">
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <button type="submit" class="btn btn-primary btn-lg" style="font-size: 16px;">
                            <i class="fa fa-save"></i> Registrar Célula
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <style>
            .table th,
            .table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            #tableCelula tbody tr:hover {
                cursor: pointer;
                /* Cambia el cursor a una mano cuando se pasa sobre la fila */
            }
        </style>

        <section class="content-header">
            @csrf
            <div class="row">
                <div class="col-md-12">

                    <table id="tableCelula" width="100%"
                        class='table dataTables_wrapper container-fluid dt-bootstrap4 no-footer'></table>
                </div>
            </div>
        </section>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/celula/index.js') }}"></script>
@endsection
