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
                                    value="{{ isset($Entity) && $Entity->vehiculo ? $Entity->vehiculo->tipo->nombre : '' }}"
                                    readonly>
                                <span data-valmsg-for="tipo" class="text-danger"></span>
                            </div>

                            <!-- Tarifa -->
                            <div class="col-md-6">
                                <label for="tarifa">Monto por hora/fracción</label>
                                <input type="text" class="form-input" name="tarifa" id="tarifa"
                                    value="{{ isset($Entity) && $Entity->vehiculo ? $Entity->vehiculo->tipo->montoxhora : '' }}"
                                    readonly>
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
                        style="display:none; width: 250px; margin: 20px auto; font-family: Arial, sans-serif; background: #ffffff; padding: 10px; border-radius: 8px; font-size: 9px; line-height: 1.2; word-wrap: break-word;">

                        <!-- Título y dirección centrados -->
                        <h3
                            style="margin: 0; font-size: 12px; font-weight: bold; padding-bottom: 5px; text-align: center; word-wrap: break-word;">
                            {{ isset($empresa) && $empresa ? $empresa->nombre : 'Empresa no disponible' }}
                        </h3>
                        <p
                            style="margin: 0; font-size: 10px; font-weight: bold; padding-bottom: 10px; text-align: center; word-wrap: break-word;">
                            {{ isset($empresa) && $empresa ? $empresa->direccion : 'Dirección no disponible' }}
                        </p>

                        <!-- Título de Ticket -->
                        <p
                            style="margin: 0; font-size: 10px; font-weight: bold; padding-bottom: 10px; text-align: center; word-wrap: break-word;">
                            TICKET DE INGRESO
                        </p>

                        <!-- Información cliente y cajero -->
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span style="font-weight: bold;">Cliente: </span><span id="ticket-cliente">DIVERSOS</span>
                        </p>
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span style="font-weight: bold;">Cajero: </span><span
                                id="ticket-cajero">{{ isset($User) && $User ? $User->nombres : 'Usuario no disponible' }}</span>
                        </p>

                        <!-- Línea separadora -->
                        <svg width="100%" height="1">
                            <line x1="0" y1="0" x2="100%" y2="0" stroke="#000"
                                stroke-width="1" stroke-dasharray="5,5" />
                        </svg>


                        <!-- Información adicional -->
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span style="font-weight: bold;">Nº Placa: </span><span id="ticket-placa"></span>
                        </p>
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span style="font-weight: bold;">F. Emisión: </span><span id="ticket-fecha"></span>
                        </p>
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span style="font-weight: bold;">Hora Ing.: </span><span id="ticket-hora-ingreso"></span>
                        </p>

                        <!-- Tipo y tarifa -->
                        <p
                            style="font-size: 9px; text-align:left; padding-bottom: 5px; margin: 0; word-wrap: break-word;">
                            <span id="ticket-tipo"></span> - <span id="ticket-tarifa"></span> S/ <span
                                id="ticket-tarifa-monto"></span> X HORA
                        </p>

                        <!-- Línea separadora -->
                        <svg width="100%" height="1">
                            <line x1="0" y1="0" x2="100%" y2="0" stroke="#000"
                                stroke-width="1" stroke-dasharray="5,5" />
                        </svg>


                        <!-- Horario de operación centrado -->
                        <p
                            style="font-size: 9px; text-align: center; padding-top: 10px; margin: 0; word-wrap: break-word;">
                            HORARIO DE LUNES A SABADO DE 8:00 A.M A 7:30 P.M
                        </p>

                        <br>

                        <!-- Código de barras centrado -->
                        <div id="barcode-container" style="text-align: center; max-width: 100%; overflow: hidden;">
                            <svg id="barcode"></svg>
                            <!-- Aquí se generará el código de barras -->
                        </div>
                        <style>
                            #barcode {
                                width: 150px;
                            }
                        </style>
                    </div>
                </div>
                <br><br>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-bold btn-pure btn-primary"><i
                            class="fa fa-folder-open"></i>
                        {{ isset($Entity) ? 'Modificar' : 'Registrar' }} Ticket
                    </button>
                    <button name="btn-imprimir" type="button" class="btn btn-bold btn-pure btn-primary"
                        style="background-color:#34495e" onclick="imprimirTicket()"><i class="fa fa-paste"></i>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

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

                    // Generar el código de barras con el número de placa
                    JsBarcode("#barcode", placa.val(), {
                        format: "CODE128", // Formato más compatible y legible
                        lineColor: "#000",
                        width: 2,
                        height: 50,
                        displayValue: false, // Mostrar el número de placa debajo del código
                    });
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
        const ticketPreview = document.getElementById("ticket-preview");

        // Usar html2pdf para generar el PDF
        const opt = {
            margin: 5, // Reducir los márgenes
            filename: 'ticket.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2, // Mantener la escala moderada para mejorar la calidad sin que sea demasiado grande
                dpi: 300, // Aumentar la calidad de la imagen
                letterRendering: true // Asegura que las fuentes sean renderizadas correctamente
            },
            jsPDF: {
                unit: 'mm',
                format: 'a7', // El formato 'a7' es más pequeño, ajusta el contenido
                orientation: 'portrait', // Asegura que el ticket esté en modo vertical
                compress: true // Comprimir el PDF generado para reducir su tamaño
            }
        };

        // Llamar a html2pdf para convertir el ticket en PDF y obtener el archivo en formato Blob
        html2pdf().from(ticketPreview).set(opt).output('blob').then(function(blob) {
            // Crear una URL para el Blob (el PDF generado)
            const url = URL.createObjectURL(blob);

            // Abrir el archivo PDF en una nueva ventana o pestaña
            const nuevaVentana = window.open(url, '_blank');

            // Si deseas agregar un botón para imprimir en la nueva ventana
            nuevaVentana.onload = function() {
                nuevaVentana.print();
            };
        });
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
