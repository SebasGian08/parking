<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="WebAltoque">
    <meta name="Resource-type" content="Document">
    <meta http-equiv="X-UA-Compatible" content="IE=5; IE=6; IE=7; IE=8; IE=9; IE=10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Ingresar | Control de Asistencia</title>
    <link rel="stylesheet" href="{{ asset('auth/css/login/index.min.css') }}">
</head>

<body>

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

</body>

</html>
