<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.ial.edu.pe/isotipo.png">
    <meta name="title" content="Instituto Arzobispo Loayza"/>
    <meta name="description" content=""/>
    <meta name="keywords" content="">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="Instituto Arzobispo Loayza">
    <meta property="og:type" content="website">
    <meta name="author" content="MAJML" />
    <meta name="Resource-type" content="Document" />
    <link rel="shortcut icon" href="{{ asset('app/img/logo_ial.png') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=5; IE=6; IE=7; IE=8; IE=9; IE=10">
    <title>Bolsa de Trabajo</title>
    <link rel="stylesheet" href="{{ asset('app/plugins/bootstrap4/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/owl-carousel/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app/plugins/toastr/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('app/css/app.min.css') }}">
    @yield('styles')
</head>
<body>

    <div id="loading">
        <i class="fa fa-refresh fa-spin" aria-hidden="true"></i>
    </div>

    @if (Auth::guard('alumnos')->check() || Auth::guard('empresasw')->check())
        <header class="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <a class="navbar-brand" href="{{ route('index') }}">
                                <img src="{{ asset('app/img/logo.png') }}" alt="Instituto Arzobispo Loayza" class="logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="mainmenu">

                                <ul class="navbar-nav ml-auto">
                                    @if(Auth::guard('alumnos')->check() || Auth::guard('empresasw')->check())
                                    {{-- {{ Auth::guard('alumnos')->user()->usuario_alumno }} --}}
                                    {{-- {{ Auth::guard('empresasw')->check() }} --}}
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ Auth::guard('alumnos')->check() ? route('alumno.perfil') : route('empresa.perfil') }}">
                                            <i class="fa fa-user"></i>
                                            Hola, {{ Auth::guard('alumnos')->check() ? (Auth::guard('alumnos')->user()->nombres." ".Auth::guard('alumnos')->user()->apellidos) : Auth::guard('empresasw')->user()->nombre_comercial }}
                                        </a>
                                    </li>
                                    @if (Auth::guard('alumnos')->check())
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('alumno.postulaciones') }}">
                                                <i class="fa fa-bell"></i> Mis Postulaciones
                                            </a>
                                        </li>                                    
                                    @endif
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0)" onclick="event.preventDefault();localStorage.setItem('cliente_id','');document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off"></i> {{ __('Cerrar Sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ Auth::guard('alumnos')->check() ? route('alumno.logout') : route('empresa.logout') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="text" name="validacion" value="{{ Auth::guard('alumnos')->check() ? Auth::guard('alumnos')->user()->usuario_alumno : Auth::guard('empresasw')->user()->usuario_empresa }}">
                                        </form>
                                    </li>
                                    @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('auth.login') }}"> <i class="fa fa-user"></i> Administrador</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>        
    @endif


    @yield('content')

    @if (Auth::guard('alumnos')->check() || Auth::guard('empresasw')->check())
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-4 col-sm-6">
                        <p class="text"><span class="text-uppercase"><b> Licenciados por Minedu </b><br>
                        Informes</span>: (01) 330-9090 | <a href="mailto:bolsadetrabajo@arzobispoloayza.edu.pe">bolsadetrabajo@arzobispoloayza.edu.pe</a></p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <h5 class="sub-title">Bolsa Laboral</h5>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <ul>
                            <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        </ul>
                    </div>
                    <hr>
                    <div class="col-12 copyright">
                        <p>MAJML - Todos los derechos reservados para Instituto Arzobispo Loayza &copy; <?php echo date('Y') ?> </p>
                    </div>
                </div>
            </div>
        </footer>        
    @endif
    {{-- <script>
        document.addEventListener("keydown", function(e) {
            // Deshabilitar F12
            if (e.keyCode === 123) {
                e.preventDefault();
                return false;
            }

            // Deshabilitar Ctrl+Shift+I (DevTools)
            if (e.ctrlKey && e.shiftKey && e.keyCode === 73) {
                e.preventDefault();
                return false;
            }

            // Deshabilitar Ctrl+U (Ver fuente)
            if (e.ctrlKey && e.keyCode === 85) {
                e.preventDefault();
                return false;
            }
        });

        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        });
    </script> --}}


    <script type="text/javascript" src="{{ asset('app/plugins/jquery/3.5.1/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/plugins/bootstrap4/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('app/plugins/toastr/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('auth/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('app/js/_Layout.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
