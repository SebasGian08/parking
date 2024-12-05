@extends('auth.index')

@section('titulo')
    <title>Registro de Usuarios</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('auth/plugins/datatable/datatables.min.css') }}">
@endsection

@section('contenido')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>
                Listado de Usuarios
            </h1>

            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <button type="button" id="modalRegistrarUsuarios" class="btn-primary"><i class="fa fa-plus"></i> Registrar
                        Usuario</button>
                </li>
            </ol>
        </section>

        <section class="content">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="content-header">
                        <table id="tableUsuarios"
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
    <script type="text/javascript" src="{{ asset('auth/js/usuarios/index.js') }}"></script>
@endsection
