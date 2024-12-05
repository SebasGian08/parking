<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>



<div id="barcodeModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #007bff;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" style="position: relative;">
                <img src="{{ asset('auth/image/carnet.jpg') }}" alt=""
                    style="width: 100%; height: auto; position: absolute; top: 0; left: 0;">
                <div style="position: relative; z-index: 2; margin-top: 20px;">
                    <img src="{{ $Entity->avatar ? asset($Entity->avatar->file_name) : asset('path/to/default/avatar.jpg') }}"
                        alt="{{ $Entity->avatar ? $Entity->avatar->name : 'Avatar por defecto' }}"
                        style="max-width: 100px; display: block; margin: 10px auto; margin-top: 100px !important;">

                    <h3 style="margin-top: 50px; font-size: 24px; font-weight: bold; color: #292929;">
                        {{ $Entity->nombre }} {{ $Entity->apellido }}
                    </h3>

                    <p
                        style="font-size: 10px; color: #ffffff; background-color: #231e54; 
                              border-radius: 30px; padding: 10px; margin-top: 2px; display: inline-block;">
                        {{ $Entity->cargo ? $Entity->cargo->nombre : 'No asignado' }}
                    </p>

                    <div id="employeeDetails"></div>
                </div>
                <svg class="barcode" width="150" height="50"
                    style="position: absolute; z-index: 1; top: 500px; left: 50%; transform: translateX(-50%);"></svg>
            </div>
            <!-- Botón de descarga fuera del modal -->
            <div class="text-center" style="margin-top: 40px; margin-bottom: 20px;">
                <button id="downloadImage" class="btn btn-primary"
                    style="
                    background-color: #ff5733; /* Color vibrante */
                    border: none; /* Sin borde */
                    border-radius: 13px; /* Bordes redondeados */
                    color: white; /* Color del texto */
                    font-size: 10px;
                    padding: 10px 30px;
                    transition: background-color 0.3s, transform 0.2s;"
                    onmouseover="this.style.backgroundColor='#c70039'; this.style.transform='scale(1.05)';"
                    onmouseout="this.style.backgroundColor='#ff5733'; this.style.transform='scale(1)';">
                    <i class="fa fa-download" style="margin-right: 8px;"></i> Descargar Carnet
                </button>
            </div>

        </div>
    </div>
</div>



<script>
    // Generar el código de barras al abrir el modal
    $('#barcodeModal').on('shown.bs.modal', function() {
        var dni = "{{ $Entity->dni }}"; // Obtén el DNI del empleado
        JsBarcode(".barcode", dni, {
            format: "CODE128",
            lineColor: "#231e54",
            width: 2,
            height: 50,
            displayValue: true
        });
    });

    // Descargar la imagen del contenido del modal
    $('#downloadImage').on('click', function() {
        html2canvas(document.querySelector('.modal-body'), {
            scale: 2
        }).then(canvas => {
            const link = document.createElement('a');
            const fullName = "{{ $Entity->nombre }}_{{ $Entity->apellido }}";
            link.href = canvas.toDataURL('image/png');
            link.download = `carnet_${fullName}.png`;
            link.click();
        });
    });
</script>


<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
