@extends('auth.index')

@section('titulo')
    <title>BolsaTrabajo | Programas de Inserción rápida</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection
{{-- <style type="text/css">
    .txt_claro {
        background: #79f57f63;
        /* color: #fff; */
    }

    .label-as-badge {
        border-radius: 1em;
        font-size: 12px;
        cursor: pointer;
    }

    table.dataTable th,
    table.dataTable td {
        white-space: nowrap;
    }

    .sorting_1 {
        padding-left: 30px !important;
    }
</style> --}}

@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Publicar Programas de Inserción rápida
                <small>Mantenimiento</small>
            </h1>
        </section>

        <br>
        <div class="content-header">
            <div class="row">
                <form class="col-lg-4 col-md-4" action="{{ route('auth.programa.store') }}" method="post">

                    @csrf
                    <div class="form-group col-lg-12">
                        <label for="registro" class="m-0 label-primary">Fecha</label>
                        <input type="date" class="form-control form-control-sm" id="registro"
                            name="registro" value="{{ old('registro') }}" required>
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="tipo_programa" class="m-0 label-primary">Programa <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <select name="tipo_programa" id="tipo_programa" class="form-control form-control-sm" required>
                            <option value="">Seleccione</option>
                            <option value="Feria laboral" {{ old('tipo_programa') == 'Feria laboral' ? 'selected' : '' }}>
                                Feria laboral</option>
                            <option value="Talent Day" {{ old('tipo_programa') == 'Talent Day' ? 'selected' : '' }}>Talent
                                Day</option>
                            <option value="Nexo Laboral" {{ old('tipo_programa') == 'Nexo Laboral' ? 'selected' : '' }}>Nexo
                                Laboral</option>
                            <option value="Contrata Talento"
                                {{ old('tipo_programa') == 'Contrata Talento' ? 'selected' : '' }}>Contrata Talento</option>
                        </select>

                    </div>
                    <div class="form-group col-lg-12">
                        <label for="empresa" class="m-0 label-primary">Empresa <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <input autocomplete="off" type="text" class="form-control form-control-sm" id="empresa"
                            name="empresa" value="{{ old('empresa') }}" required placeholder="Nombre Empresa">
                    </div>
                    <div class="form-group col-lg-12">
                        <label for="puestouno" class="m-0 label-primary">Puesto 1 <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <input autocomplete="off" type="text" class="form-control form-control-sm" id="puestouno"
                            name="puestouno" value="{{ old('puestouno') }}" required placeholder="Ingresar puesto uno">
                    </div>
                    <div id="nuevosPuestos"></div>
                    <button type="button" class="btn btn-link" onclick="agregarPuesto()"
                        style="margin-bottom: 20px;margin-top: -20px;font-size:12px">
                        <i class="fa fa-plus-circle mr-1"></i>Agregar otro puesto (Máximo 4)
                    </button>
                    <div class="form-group col-lg-12">
                        <label for="responsable" class="m-0 label-primary">Responsable <b
                                style="color:red;font-size:10px">(Obligatorio*)</b></label>
                        <select name="responsable" id="responsable" class="form-control form-control-sm" required>
                            <option value="">Seleccione</option>
                            <option value="Bryan Julcamoro" {{ old('responsable') == 'Bryan Julcamoro' ? 'selected' : '' }}>
                                Bryan Julcamoro
                            </option>
                            <option value="Joselyn Condori"
                                {{ old('responsable') == 'Joselyn Condori' ? 'selected' : '' }}>Joselyn Condori
                            </option>
                            <option value="Stefany Gutierrez"
                                {{ old('responsable') == 'Stefany Gutierrez' ? 'selected' : '' }}>Stefany Gutierrez
                            </option>
                            <option value="Yamile Bazan" {{ old('responsable') == 'Yamile Bazan' ? 'selected' : '' }}>
                                Yamilé Bazán</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-12">

                        <button type="submit" class="btn btn-primary" style="border-color:#2ecc71 !important;">Guardar
                            Programa</button>
                    </div>
                </form>
                <div class="col-lg-8 col-md-8">
                    <div class="table-wrapper">
                        <table id="tablePrograma" class="display table table-bordered table-hover table-condensed">
                            <!-- Aquí se puede agregar un caption para la tabla si es necesario -->
                        </table>
                    </div>
                    <div class="form-group col-lg-3 col-md-12 d-flex flex-column">
                        <a href="javascript:void(0)" class="btn-m btn-success-m" onclick="clickExcelAlumno()">
                            <i class="fa fa-file"></i> Exportar excel
                        </a>
                    </div>
                </div>



                <style>
                    #tablePrograma {

                        max-width: 100%;
                        /* Asegura que la tabla ocupe todo el ancho del contenedor */
                    }
                </style>
            </div>
        </div>

        <script>
            var numPuestosAgregados = 0;
            var nombresPuestos = ['dos', 'tres', 'cuatro'];

            function agregarPuesto() {
                if (numPuestosAgregados < 3) {
                    numPuestosAgregados++;

                    var nuevosPuestosDiv = document.getElementById('nuevosPuestos');
                    var nuevoPuestoHTML = `
                <div class="form-group col-lg-12">
                    <label for="puesto${nombresPuestos[numPuestosAgregados - 1]}" class="m-0 label-primary">Puesto ${nombresPuestos[numPuestosAgregados - 1].charAt(0).toUpperCase() + nombresPuestos[numPuestosAgregados - 1].slice(1)} <b style="color:green;font-size:10px">(Opcional)</b></label>
                    <input autocomplete="off" type="text" class="form-control form-control-sm" id="puesto${nombresPuestos[numPuestosAgregados - 1]}" name="puesto${nombresPuestos[numPuestosAgregados - 1]}">
                </div>
            `;
                    nuevosPuestosDiv.insertAdjacentHTML('beforeend', nuevoPuestoHTML);

                    // Ocultar el botón después de agregar cuatro puestos
                    if (numPuestosAgregados === 3) {
                        var botonAgregar = document.querySelector('.btn-link');
                        botonAgregar.style.display = 'none';
                    }
                }
            }
        </script>
        {{-- Fin de Script --}}

        {{--  <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <table id="tableAvisoPostulantes" width="100%" class='display responsive no-wrap table table-bordered table-hover table-condensed'></table>
                </div>
            </div>
        </section> --}}

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/datatable/dataTables.config.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/js/programa/index.js') }}"></script>
@endsection
