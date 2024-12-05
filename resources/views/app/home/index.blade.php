{{-- @extends('app.index') --}}

@section('styles')
    {{-- <link rel="stylesheet" href="{{ asset('app/css/home/index.css') }}"> --}}
@endsection

@section('content')
@endsection
<script src="https://kit.fontawesome.com/6f8129a9b1.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('app/css/home/login.css') }}">

<section class="section_login">

    <div class="content_view_login">
        <div class="sect_login">
            <div class="content_login">
                <style>
                    .title_ {
                        font-size: 24px;
                        color: #333;
                    }

                    .reloj {
                        font-family: 'Share Tech Mono', monospace;
                        color: #252525 !important;
                        position: relative;
                        margin: 10px auto;
                    }

                    .tiempo {
                        font-weight: bold;
                        font-size: 50px;
                        padding: 5px 0;
                        color: #252525 !important;
                    }

                    .fecha {
                        /* letter-spacing: 0.1em; */
                        font-size: 18px;
                        color: #252525 !important;
                    }
                </style>
                <div class="content_titulo_login">
                    @if ($empresa && $empresa->logo)
                        <img src="{{ asset($empresa->logo) }}" alt="JAC" style="width:80px;">
                    @endif
                    <p class="title_" style="font-size:15px;">REGISTRO DE ASISTENCIA</p>
                    <div class="reloj">
                        <p class="fecha" style="text-transform: uppercase;"></p>
                        <p class="tiempo"></p>
                    </div>
                    <script>
                        function actualizarReloj() {
                            const now = new Date();
                            const opcionesFecha = {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            };
                            const fecha = now.toLocaleDateString('es-ES', opcionesFecha);
                            const tiempo = now.toLocaleTimeString('es-ES', {
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit'
                            });

                            document.querySelector('.fecha').textContent = fecha;
                            document.querySelector('.tiempo').textContent = tiempo;
                        }

                        setInterval(actualizarReloj, 1000);
                        actualizarReloj(); // Llama la función una vez para inicializar
                    </script>
                </div>
                <form class="form-asistencia" action="{{ route('home.store') }}" method="post" id="asistenciaForm">
                    @csrf
                    <div class="form-group">
                        <label for="dni" class="text-primary-m">DNI</label>
                        <input type="text" id="dni" name="dni"
                            class="form-control-m {{ $errors->has('dni') ? ' is-invalid' : '' }}"
                            placeholder="Introduce tu DNI" value="{{ old('dni') }}" required maxlength="11"
                            pattern="\d*" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div><br>
                    <script>
                        document.getElementById('dni').addEventListener('input', function(e) {
                            this.value = this.value.replace(/[^0-9]/g, ''); // Solo permite números
                        });
                        document.addEventListener("DOMContentLoaded", function() {
                            document.getElementById("dni").focus();
                        });
                    </script>
                    <div class="form-group">
                        <label for="tipo" class="text-primary-m">Tipo de Registro</label>
                        <select id="tipo_id" name="tipo_id"
                            class="form-control-m {{ $errors->has('tipo') ? ' is-invalid' : '' }}" required>
                            <option value="" disabled selected>Selecciona una opción</option>
                            @foreach ($tipo as $item)
                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br><br>

                    <input type="hidden" name="latitud" id="latitud" required>
                    <input type="hidden" name="longitud" id="longitud" required>

                    <button type="submit" class="btn-m btn-primary-gradient"
                        style="border-radius:20px;">Registrar</button>
                    <br><br>

                    {{-- Mensajes de éxito y error --}}
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <i class="fas fa-exclamation-circle"></i>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                </form>

                <script>
                    document.getElementById('asistenciaForm').addEventListener('submit', function(event) {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                document.getElementById('latitud').value = position.coords.latitude;
                                document.getElementById('longitud').value = position.coords.longitude;
                                // Una vez que se hayan capturado las coordenadas, el formulario se envía
                                event.target.submit();
                            }, function() {
                                alert(
                                    'No se pudo obtener la ubicación. Por favor, verifica la configuración de ubicación.'
                                );
                            });
                            event.preventDefault(); // Previene el envío del formulario hasta que se obtengan las coordenadas
                        } else {
                            alert('Geolocalización no es soportada por este navegador.');
                        }
                    });
                </script>

            </div>
        </div>
    </div>
</section>
