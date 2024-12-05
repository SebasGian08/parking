
function clickExcel() {
    $(".dt-buttons .buttons-excel").click();
}
var $dataTableExtras, $dataTable;
$(function () {
    const $table = $("#tableExtras");

    $dataTableExtras = $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                title: 'Lista de Extras',
                className: 'btn btn-success' // Clase para estilizar el botón
            }
        ],
        ajax: {
            url: "/auth/extras/list_all",
        },
        columns: [
            { title: "ID", data: "id", className: "text-center" },
            { title: "DNI ", data: "dni" },
            {
                title: "Nombres y Apellidos",
                data: "empleado", // Aquí estamos pasando el objeto empleado
                className: "text-center",
                render: function (data) {
                    return data ? `${data.nombre} ${data.apellido}` : "-";
                },
            },
            { title: "Horas ", data: "horas" },
            { title: "Minutos ", data: "minutos" },
            /* { title: "Documento ", data: "documento" }, */
            {
                title: "Estado",
                data: "estado",
                className: "text-center",
                render: function (data) {
                    const statusMap = {
                        0: { text: "Pendiente", class: "badge badge-warning" }, // Color amarillo
                        1: { text: "Aprobada", class: "badge badge-success" }, // Color verde
                        2: { text: "Rechazado", class: "badge badge-danger" }, // Color rojo
                    };
            
                    const { text = "Desconocido", class: statusClass = "badge badge-secondary" } = statusMap[data] || {};
            
                    return `<span class="${statusClass}">${text}</span>`;
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
                data: null,
                defaultContent:
                    "<div class='btn-group' role='group'>" +
                        "<button type='button' class='btn btn-secondary btn-sm btn-update mx-1' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>" +
                        "<button type='button' class='btn btn-danger btn-sm btn-delete mx-1' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>" +
                    "</div>",
                orderable: false,
                searchable: false,
                width: "90px", // Ajusta el ancho según sea necesario
            }
            
            
        ],
    });

    $table.on("click", ".btn-update", function () {
        const id = $dataTableExtras.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableExtras.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/extras/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $dataTableCargo.ajax.reload(null, false);
            }
        );
    });

    $("#modalRegistrarExtras").on("click", function () {
        invocarModalViewAgregar();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/extras/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableExtras.ajax.reload(null, false);
            }
        );
    }

    function invocarModalViewAgregar(id) {
        invocarModal(
            `/auth/extras/partialViewAgregar/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableExtras.ajax.reload(null, false);
            }
        );
    }
});
