<div id="modalMantenimientoTickets" class="modal modal-fill fade" data-backdrop="false" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form enctype="multipart/form-data" action="{{ route('auth.tickets.store') }}" id="registroTickets" method="POST"
            data-ajax="true" data-close-modal="true" data-ajax-loading="#loading"
            data-ajax-success="OnSuccessRegistroTickets" data-ajax-failure="OnFailureRegistroTickets">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ isset($Entity) ? 'Modificar' : 'Registrar' }} Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id" value="{{ $Entity != null ? $Entity->id : 0 }}">
                    <!-- Placa -->
                    <div class="form-group">
                        <div class="row">
                            <!-- ID del usuario -->
                            <input type="hidden" id = 'user_id' name="user_id" value="{{ $userId }}" required>
                            <input type="hidden" id="vehiculo_id" name="vehiculo_id" value="">

                            <div class="form-group col-lg-6">
                                <label for="placa" class="m-0 label-primary">Placa
                                    <b style="color:red;font-size:10px">(Obligatorio*)</b>
                                </label>
                                <div class="input-group">
                                    <!-- Input para buscar placas -->
                                    <input autocomplete="off" type="text" class="form-control form-control-sm"
                                        id="placa" name="placa" placeholder="Ingresar placa" list="listaPlacas"
                                        value="{{ isset($Entity) ? $Entity->vehiculo->placa : '' }}" required>

                                    <!-- Botón para buscar manualmente -->
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" style="background-color:#ffa200"
                                            id="btnBuscarPlaca" type="button">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                                <datalist id="listaPlacas">
                                    <!-- Las opciones dinámicas se añadirán aquí -->
                                </datalist>
                                <div class="invalid-feedback">
                                    Por favor ingresa una placa válida.
                                </div>
                            </div>

                            <!-- Tipo de Vehículo -->
                            <div class="col-md-6">
                                <label for="tipo">Tipo de Vehículo</label>
                                <input type="text" class="form-input" name="tipo" id="tipo"
                                       value="{{ isset($Entity) && $Entity->vehiculo ? $Entity->vehiculo->tipo->nombre : '' }}" readonly>
                                <span data-valmsg-for="tipo" class="text-danger"></span>
                            </div>
                            
                            <!-- Tarifa -->
                            <div class="col-md-6">
                                <label for="tarifa">Monto por hora/fracción</label>
                                <input type="text" class="form-input" name="tarifa" id="tarifa"
                                       value="{{ isset($Entity) && $Entity->vehiculo ? $Entity->vehiculo->tipo->montoxhora : '' }}" readonly>
                                <span data-valmsg-for="tarifa" class="text-danger"></span>
                            </div>
                            <!-- Hora de Inicio -->
                            <div class="col-md-6">
                                <label for="tiempo_inicio">Tiempo de Inicio</label>
                                <input type="text" class="form-input" name="tiempo_inicio" id="tiempo_inicio"
                                    value="{{ isset($Entity) ? $Entity->tiempo_inicio : '' }}" readonly>
                                <span data-valmsg-for="tiempo_inicio" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="background-color: #f1f1f175">
                    <div id="ticket-preview"
                        style="display:none; width: 300px; margin: 0 auto; font-family: Arial, sans-serif; background: #ffffff; padding: 20px; text-align: center; border: 1px dashed #b8b8b8; border-radius: 8px;">
                        <h3
                            style="margin: 0; font-size: 18px; font-weight: bold; padding-bottom: 15px; text-align: center;">
                            {{ isset($empresa) && $empresa ? $empresa->nombre : 'Empresa no disponible' }}
                        </h3>
                        <p
                            style="margin: 0; font-size: 14px; font-weight: bold; padding-bottom: 10px; text-align: center;">
                            {{ isset($empresa) && $empresa ? $empresa->direccion : 'Dirección no disponible' }}
                        </p>
                        <p
                            style="margin: 0; font-size: 14px; font-weight: bold; padding-bottom: 15px; text-align: center;">
                            TICKET DE INGRESO</p>

                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;"><span
                                style="font-weight: bold;">Cliente: </span><span id="ticket-cliente">DIVERSOS</span></p>
                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;"><span
                                style="font-weight: bold;">Cajero: </span><span
                                id="ticket-cajero">{{ isset($User) && $User ? $User->nombres : 'Usuario no disponible' }}</span>
                        </p>

                        <hr style="border: 1px dashed #000; width: 100%; margin: 10px 0;">

                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;"><span
                                style="font-weight: bold;">Nº Placa: </span><span id="ticket-placa"></span></p>
                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;"><span
                                style="font-weight: bold;">F. Emisión: </span><span id="ticket-fecha"></span></p>
                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;"><span
                                style="font-weight: bold;">Hora Ing.: </span><span id="ticket-hora-ingreso"></span>
                        </p>
                        <!-- Agregar Tipo y Tarifa juntos con un guion después de la Hora de Ingreso -->
                        <p style="font-size: 12px; text-align:left; padding-bottom: 5px; margin: 0;">
                            <span id="ticket-tipo"></span> - <span id="ticket-tarifa"></span> S/ <span
                                id="ticket-tarifa-monto"></span> X HORA
                        </p>
                        <hr style="border: 1px dashed #000; width: 100%; margin: 10px 0;">
                        <p style="font-size: 12px; text-align: center; padding-top: 15px; margin: 0;">HORARIO DE LUNES
                            A SABADO DE 8:00 A.M A 7:30 P.M</p>
                        <br><br><br><br>
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary"><i
                            class="fa fa-folder-open"></i>
                        {{ isset($Entity) ? 'Modificar' : 'Registrar' }} Ticket
                    </button>
                    <button name="btn-imprimir" type="button" class="btn btn-bold btn-pure btn-primary" style="background-color:#34495e"
                        onclick="imprimirTicket()"><i class="fa fa-paste"></i>
                        Imprimir Ticket
                    </button>

                    <button type="button" id="modalRegistrarCliente" class="btn-primary"
                        style="background:white;border: 2px solid #2ecc71; color: #2ecc71; "><i
                            class="fa fa-plus"></i> Nuevo
                        Vehiculo</button>

                </div>
            </div>
        </form>
    </div>

</div>



{{-- <script>
    function buscarPorPlaca() {
        const placa = document.getElementById('placa').value;

        if (!placa) {
            swal("Error!", "Complete la placa", "error");
            return;
        }

        // Realiza la solicitud AJAX para buscar la placa
        fetch(`/auth/tickets/placa/${placa}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener la información de la placa.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {


                    // Rellena los campos con los datos obtenidos
                    document.getElementById('tipo').value = data.tipo;
                    document.getElementById('tarifa').value = data.tarifa;
                    document.getElementById('vehiculo_id').value = data.id;

                    // Obtiene la hora actual y la asigna al campo 'hora_inicio' en formato HH:mm
                    const now = new Date();
                    const horaActual = now.toLocaleTimeString('es-PE', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    });

                    document.getElementById('hora_inicio').value = horaActual;

                    // Muestra la vista previa del ticket
                    document.getElementById('ticket-preview').style.display = 'block';
                    document.getElementById('ticket-placa').textContent = placa;
                    document.getElementById('ticket-tipo').textContent = data.tipo; // Tipo de vehículo
                    document.getElementById('ticket-tarifa').textContent = data.tarifa; // Tarifa
                    document.getElementById('ticket-fecha').textContent = now.toLocaleDateString();
                    document.getElementById('ticket-hora-ingreso').textContent = horaActual;
                    document.getElementById('ticket-cliente').textContent = 'DIVERSOS';

                } else {
                    swal("Verificar!", "No existe el vehiculo con esa placa", "error");
                }
            })
            .catch(error => {
                OnFailureRegistroTickets(); // Llama a la función de fallo si ocurre un error
            });
    }



    // Función para imprimir el ticket
    function imprimirTicket() {
        const ticketPreview = document.getElementById('ticket-preview').innerHTML;
        const ventanaImpresion = window.open('', '', 'width=600,height=350'); // Ajusta el tamaño de la ventana
        ventanaImpresion.document.write(`
    <html>
        <head>
            <style>
                @page {
                    size: 57mm 35mm;  /* Establece el tamaño del ticket */
                    margin: 0;
                }
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    margin: 0;
                    padding: 0;
                }
                .ticket-container {
                    width: 57mm; /* Ajusta el ancho del ticket */
                    height: 35mm; /* Ajusta la altura del ticket */
                    padding: 10px;
                    text-align: center;
                }
                .ticket-container p {
                    margin: 0;
                    padding: 2px 0;
                    font-size: 12px;
                }
                .ticket-container hr {
                    border: 1px dashed #b8b8b8;
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <div class="ticket-container">
                ${ticketPreview}
            </div>
        </body>
    </html>
    `);
        ventanaImpresion.document.close();
        ventanaImpresion.print();
    }
</script> --}}

{{-- <script>
    $("#btnBuscarPlaca").click(function() {
        buscarInformacionPlaca(); // Llamada a la función cuando se hace click en el botón
    });

    // Detectar cuando se presiona Enter en el campo de placa
    $("#placa").keypress(function(event) {
        if (event.which === 13) {  // 13 es el código de la tecla Enter
            event.preventDefault();  // Evitar que se ejecute el comportamiento por defecto (enviar el formulario)
            buscarInformacionPlaca(); // Llamada a la función cuando se presiona Enter
        }
    });

    // Función que realiza la búsqueda
    function buscarInformacionPlaca() {
        const placa = $("#placa");

        // Verificar si el campo placa está vacío
        if ($(placa).val().trim() === '') {
            swal("", "Ingrese la placa para buscar la información.", "warning");
            return; // Salir de la función si la placa está vacía
        }

        // Realizar la solicitud AJAX para buscar por placa
        $.ajax({
            url: "/auth/tickets/placa/" + placa.val(),  // Corregido aquí
            type: "GET", // Usar GET ya que estamos obteniendo información
            dataType: "json",
            beforeSend: function() {
                // Puedes agregar un "loading" si lo necesitas
            },
            success: function(res) {
                if (res.success === true) {
                    // Llenar el campo oculto con el ID del vehículo
                    $("#vehiculo_id").val(res.id);

                    // Llenar los campos de Tipo de Vehículo y Tarifa
                    $("#tipo").val(res.tipo); // Llenar el campo de tipo de vehículo
                    $("#tarifa").val(res.tarifa); // Llenar el campo de tarifa

                    const timestamp = Math.floor(Date.now() / 1000); // Timestamp actual en segundos
                    const date = new Date(timestamp * 1000); // Convertir a milisegundos
                    const formattedDate = 
                        ('0' + date.getDate()).slice(-2) + '-' + 
                        ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                        date.getFullYear() + ', ' + 
                        ('0' + date.getHours()).slice(-2) + ':' + 
                        ('0' + date.getMinutes()).slice(-2) + ':' + 
                        ('0' + date.getSeconds()).slice(-2); // Formato dd-mm-yyyy, hh:mm:ss

                    // Llenar el campo de fecha de registro con la fecha formateada
                    $("#tiempo_inicio").val(formattedDate); // Asignar la fecha formateada al campo

                    $("#btn-registrar").prop("disabled", false); // Habilitar el botón de registrar
                } else {
                    swal("", "No se encontró información para la placa ingresada.", "warning");
                    $("#vehiculo_id").val("");
                    $("#tipo").val("");
                    $("#tarifa").val(""); 
                    $("#tiempo_inicio").val(""); 
                }
            },
            error: function() {
                swal("", "Error al buscar información. Inténtelo nuevamente más tarde.", "error");
            }
        });
    }
</script> --}}


<script>
    $("#btnBuscarPlaca").click(function() {
        buscarInformacionPlaca();
    });

    $("#placa").keypress(function(event) {
        if (event.which === 13) {
            event.preventDefault();
            buscarInformacionPlaca();
        }
    });

    function buscarInformacionPlaca() {
        const placa = $("#placa");

        if (placa.val().trim() === '') {
            swal("", "Ingrese la placa para buscar la información.", "warning");
            return;
        }

        $.ajax({
            url: "/auth/tickets/placa/" + placa.val(),
            type: "GET",
            dataType: "json",
            success: function(res) {
                if (res.success === true) {
                    $("#vehiculo_id").val(res.id);
                    $("#tipo").val(res.tipo);
                    $("#tarifa").val(res.tarifa);
                    $("#vehiculo_id").val(res.id);

                    const now = new Date();
                    const formattedDate =
                        ('0' + now.getDate()).slice(-2) + '-' +
                        ('0' + (now.getMonth() + 1)).slice(-2) + '-' +
                        now.getFullYear() + ', ' +
                        ('0' + now.getHours()).slice(-2) + ':' +
                        ('0' + now.getMinutes()).slice(-2) + ':' +
                        ('0' + now.getSeconds()).slice(-2);

                    $("#tiempo_inicio").val(formattedDate);

                    // Mostrar la vista previa del ticket
                    $("#ticket-preview").show();
                    $("#ticket-placa").text(placa.val());
                    $("#ticket-tipo").text(res.tipo);
                    $("#ticket-tarifa").text(res.tarifa);
                    $("#ticket-fecha").text(now.toLocaleDateString());
                    $("#ticket-hora-ingreso").text(now.toLocaleTimeString('es-PE', {
                        hour12: false
                    }));
                    $("#ticket-cliente").text("DIVERSOS");

                    $("#btn-imprimir").prop("disabled", false);
                } else {
                    swal("", "No se encontró información para la placa ingresada.", "warning");
                    limpiarCampos();
                }
            },
            error: function() {
                swal("", "Error al buscar información. Inténtelo nuevamente más tarde.", "error");
            }
        });
    }

    function limpiarCampos() {
        $("#vehiculo_id").val("");
        $("#tipo").val("");
        $("#tarifa").val("");
        $("#tiempo_inicio").val("");
        $("#ticket-preview").hide();
    }

    function imprimirTicket() {
        const ticketPreview = document.getElementById("ticket-preview").innerHTML;

        // Crear un iframe temporal para la impresión
        const iframe = document.createElement("iframe");
        document.body.appendChild(iframe);

        // Estilo del iframe para que no sea visible
        iframe.style.position = "absolute";
        iframe.style.width = "0";
        iframe.style.height = "0";
        iframe.style.border = "none";

        const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
        iframeDoc.open();
        iframeDoc.write(`
        <html>
            <head>
                <style>
                    @page { size: 57mm 35mm; margin: 0; }
                    body { font-family: Arial, sans-serif; font-size: 12px; margin: 0; padding: 0; }
                    .ticket-container {
                        width: 57mm;
                        padding: 10px;
                        text-align: center;
                    }
                    .ticket-container p { margin: 0; padding: 2px 0; font-size: 12px; }
                    .ticket-container hr { border: 1px dashed #b8b8b8; margin: 5px 0; }
                </style>
            </head>
            <body>
                <div class="ticket-container">${ticketPreview}</div>
            </body>
        </html>
    `);
        iframeDoc.close();

        // Llamar a la impresión en el iframe
        iframe.contentWindow.focus();
        iframe.contentWindow.print();

        // Eliminar el iframe tras la impresión
        setTimeout(() => document.body.removeChild(iframe), 500);
    }



    $(document).ready(function() {
        // Llamada AJAX para obtener las placas
        $.ajax({
            url: '/auth/tickets/listarPlacasMasFrecuentes', // URL correcta
            method: 'GET',
            success: function(data) {
                const datalist = $('#listaPlacas'); // Referencia al datalist
                datalist.empty(); // Limpia cualquier contenido anterior

                data.forEach(function(item) {
                    // Añade las opciones al datalist
                    datalist.append(
                        `<option value="${item.placa}">${item.placa} (${item.cantidad} tickets)</option>`
                    );
                });
            },
            error: function(error) {
                console.error('Error al cargar las placas:', error);
            }
        });
    });
</script>


<script type="text/javascript" src="{{ asset('auth/js/tickets/_Mantenimiento.js') }}"></script>
