function clickExcel() {
    $(".dt-buttons .buttons-excel").click();
}

$(function () {
    const $table = $("#tableAsistencia");

    var $dataTableAsistencia = $table.DataTable({
        columnDefs: [
            {
                defaultContent: "-",
                targets: "_all",
            },
        ],
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [10, 10, 20, 50, -1],
            [10, 10, 20, 50, "Todo"],
        ],
        info: false,
        ajax: {
            url: "/auth/asistencia/list_all",
            data: function (d) {
                d.desde = $("#desde").val();
                d.hasta = $("#hasta").val();
                d.dni = $("#dni").val();
            },
            dataSrc: "data",
        },
        columns: [
            {
                title: "N°",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            {
                title: "DNI",
                data: "empleado.dni",
                class: "text-center",
                render: function (data) {
                    return data ? data : "-";
                },
            },
            {
                title: "Nombres y Apellidos",
                data: "empleado",
                class: "text-center",
                render: function (data) {
                    return data ? `${data.nombre} ${data.apellido}` : "-";
                },
            },
            {
                title: "Cargo",
                data: "empleado",
                class: "text-center",
                render: function (data) {
                    return data ? `${data.cargo} ${data.apellido}` : "-";
                },
            },

            {
                title: "Hora Entrada",
                data: "hora_entrada",
                class: "text-center",
                render: function (data, type, row) {
                    if (data === null || typeof data !== 'string') {
                        return `<span class="text-rojo"> Faltó</span>`;
                    }
            
                    const horaEntrada = new Date(`1970-01-01T${data}`);
                    
                    // Acceder al horario completo
                    const horario = row.empleado.horario; // Asegúrate de que esto esté presente
            
                    if (!horario) {
                        return `<span class="text-rojo"> Sin horario</span>`;
                    }
            
                    // Usa el horario de ingreso para crear horaLimite
                    const horaLimite = new Date(`1970-01-01T${horario}`);
                    const formattedEntrada = formatTime(data);
            
                    // Comparar horaEntrada con horaLimite
                    if (horaEntrada > horaLimite) {
                        return `${formattedEntrada} <span class="text-naranja"> Tarde</span>`;
                    }
            
                    return formattedEntrada;
                },
            },
            
            {
                title: "Hora Salida",
                data: "hora_salida",
                class: "text-center",
                render: function (data) {
                    return data ? formatTime(data) : "-";
                },
            },
            {
                title: "Total Horas",
                data: null,
                class: "text-center",
                render: function (data, type, row) {
                    const horaEntrada = new Date(`1970-01-01T${row.hora_entrada}`);
                    const horaSalida = new Date(`1970-01-01T${row.hora_salida}`);

                    const diferencia = horaSalida - horaEntrada;

                    if (diferencia < 0) {
                        return "-";
                    }

                    const totalSegundos = Math.floor(diferencia / 1000);
                    const horas = Math.floor(totalSegundos / 3600);
                    const minutos = Math.floor((totalSegundos % 3600) / 60);
                    const segundos = totalSegundos % 60;

                    let resultado = "";
                    if (horas > 0) {
                        resultado += `${horas} hora${horas > 1 ? "s" : ""}`;
                    }
                    if (minutos > 0) {
                        resultado += (resultado ? ", " : "") + `${minutos} minuto${minutos > 1 ? "s" : ""}`;
                    }
                    if (segundos > 0) {
                        resultado += (resultado ? ", " : "") + `${segundos} segundo${segundos > 1 ? "s" : ""}`;
                    }

                    return resultado || "0 segundos";
                },
            },
            {
                title: "Fecha",
                data: "created_at",
                class: "text-center",
                render: function (data) {
                    if (data) {
                        const date = new Date(data);
                        const options = {
                            year: "numeric",
                            month: "2-digit",
                            day: "2-digit",
                        };
                        return date.toLocaleDateString("es-ES", options);
                    }
                    return "-";
                },
            },
            {
                title: "IP Entrada", // New column title for IP
                data: "ip_address", // Change this to match the field name from your API
                class: "text-center",
                render: function (data) {
                    return data ? data : "-"; // Return IP address or a dash if not available
                },
            },
            {
                title: "IP Salida", // New column title for IP
                data: "ip_address_salida", // Change this to match the field name from your API
                class: "text-center",
                render: function (data) {
                    return data ? data : "-"; // Return IP address or a dash if not available
                },
            },
            {
                data: null,
                render: function (data) {
                    return (
                        '<div class="btn-group">' +
                        '<a href="javascript:void(0)" class="btn-delete btn btn-danger" idDato="' +
                        data.id +
                        '"><i class="fa fa-trash"></i></a>' +
                        "</div>"
                    );
                },
            },
        ],
    });

    $("#btn-consultar").on("click", function () {
        $dataTableAsistencia.ajax.reload(null, false);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $(this).attr("idDato");
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/asistencia/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $dataTableAsistencia.ajax.reload(null, false);
            }
        );
    });

    function formatTime(timeString) {
        if (!timeString || typeof timeString !== 'string') {
            return "Formato Inválido"; // O cualquier mensaje que desees mostrar
        }
    
        const [hours, minutes, seconds] = timeString.split(":").map(Number);
        const isPM = hours >= 12;
        const formattedHours = hours % 12 || 12;
        const ampm = isPM ? "PM" : "AM";
    
        return `${formattedHours}:${String(minutes).padStart(2, "0")} ${ampm}`;
    }
    

    $("#modalRegistrarAsistencia").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/asistencia/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAsistencia.ajax.reload(null, false);
            }
        );
    }
});

