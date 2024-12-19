<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="WebAltoque">
    <meta name="Resource-type" content="Document">
    <meta http-equiv="X-UA-Compatible" content="IE=5; IE=6; IE=7; IE=8; IE=9; IE=10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Ingresar | Parking</title>
    {{-- <link rel="stylesheet" href="{{ asset('auth/css/login/index.min.css') }}"> --}}

    <link rel="stylesheet" type="text/css"
        href="{{ asset('auth/css/login/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/login/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/login/main.css') }}">
    <!-- Vincular Google Fonts para usar 'Roboto' -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
</head>

{{-- <body>
    <section class="login">
        <div class="wrap-content" style="background: rgb(0 0 0 / 60%) !important;">
            <div class="form-logo">
                @if ($empresa && $empresa->logo)
                    <img src="{{ asset($empresa->logo) }}" alt="JAC" style="width:80px;">
                @endif
            </div>
            <h3 class="form-title" style="color:white !important;">Iniciar Sesión</h3>
            <form method="post" action="{{ route('auth.login.post') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-input {{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" id="email" placeholder="Usuario" value="{{ old('email') }}" style="background-color: #ffffff4a;color:white;" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group position-relative">
                   <input type="password" class="form-input {{ $errors->has('password') ? ' is-invalid' : '' }}"
                   name="password" id="password" placeholder="Contraseña" 
                   style="background-color: #ffffff4a; color: white; placeholder-color: white;" required>
                    <style>
                      input::placeholder {
                        color: white;
                        opacity: 1; /* Asegúrate de que el texto no sea transparente */
                      }
                    </style>
                    <span id="togglePassword" class="toggle-password" role="button">👁️</span>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <script>
                    document.getElementById('togglePassword').addEventListener('click', function() {
                        const passwordInput = document.getElementById('password');
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        this.textContent = type === 'password' ? '👁️' : '🙈'; // Cambia el ícono según el estado
                    });
                </script>

                <style>
                    .position-relative {
                        position: relative;
                    }

                    .toggle-password {
                        position: absolute;
                        right: 10px;
                        /* Ajusta según sea necesario */
                        top: 50%;
                        transform: translateY(-50%);
                        cursor: pointer;
                        user-select: none;
                        /* Evita que el texto sea seleccionado al hacer clic */
                    }
                </style>

                <button type="submit" class="button">Iniciar Sesión</button>
                <br>
            </form>
        </div>
    </section>
</body> --}}
{{-- <style>
    .container-login100 {
        background: url("{{ asset('auth/image/bg.jpg') }}") no-repeat center center;
    }
</style> --}}

<body>
    <section class="login">
        <style>
            .container-login100 {
                background: url("{{ asset('auth/image/bg.jpg') }}") no-repeat center center;
                background-size: cover; /* Asegura que la imagen cubra todo el fondo */
                height: 100vh; /* Asegura que el contenedor ocupe toda la altura de la pantalla */
            }
        </style>
        
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilt>
                        <img src="{{ asset("auth/image/img-01.png") }}" alt="IMG">
                    </div>
                    <form class="login100-form validate-form" method="post" action="{{ route('auth.login.post') }}">
                        @csrf

                        <div class="form-logo">
                            @if ($empresa && $empresa->logo)
                                <img src="{{ asset($empresa->logo) }}" alt="JAC" style="width:200px;">
                            @endif
                        </div>
                        <span class="login100-form-title title">
                            Inicia sesión para continuar
                        </span>
                        <!-- Usuario -->
                        <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                            <input class="input100 title {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                type="text" name="email" placeholder="Usuario" value="{{ old('email') }}"
                                required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>

                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert" style="margin">
                                <strong style="color:red">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <!-- Contraseña -->
                        <br><br>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100 title {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                type="password" name="password" placeholder="Contraseña" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn title button" type="submit">
                                Ingresar
                            </button>
                        </div>
                        <div class="text-center p-t-136">
                            <a class="txt2 title" href="#" style="color: rgb(206, 206, 206);">
                                Desarrollado por Onsystems
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
