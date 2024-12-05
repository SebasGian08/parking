function clickExcel() {
    $(".dt-buttons .buttons-excel").click();
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#buscardni").click(function () {
        var dni = $("#dni").val();

        if (dni.length < 1 || dni.length > 8) {
            swal(
                "",
                "Por favor ingresa un DNI válido (entre 1 y 8 dígitos)",
                "warning"
            );
            return;
        }

        $.ajax({
            url: "/auth/memorandum/buscar-dni", // Cambiado aquí
            type: "POST",
            data: {
                dni: dni,
            },
            success: function (data) {
                $("#nombres").val(data.nombre + " " + data.apellido);
            },
            error: function (xhr) {
                if (xhr.status === 404) {
                    swal(
                        "Error",
                        xhr.responseJSON.error || "Empleado no encontrado",
                        "warning"
                    );
                } else {
                    swal(
                        "Error",
                        "Error en la búsqueda: " + xhr.statusText,
                        "error"
                    );
                }
            },
        });
    });
});

$(function () {
    const $table = $("#tableMemorandum");

    var $dataTableMemorandum = $table.DataTable({
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
            url: "/auth/memorandum/list_all",
            data: function (s) {},
        },
        columns: [
            {
                title: "N°",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            { title: "DNI", data: "dni", class: "text-center" },
            {
                title: "Nombre",
                data: null,
                class: "text-center",
                render: function (data, type, row) {
                    return row.empleado.nombre + " " + row.empleado.apellido;
                },
            },
            { title: "Telefono", data: "empleado.tel", class: "text-center" },
            { title: "Correo", data: "empleado.email", class: "text-center" },
            {
                title: "Fecha de creación",
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
                render: function (data) {
                    const telefono = data.empleado.tel;
                    const email = data.empleado.email;
                    const pdfLink = `${window.location.origin}/auth/memorandum/generar-pdf/${data.id}`;
                    const mensaje = `Hola, te saludamos del Área de Planillas. Este es un recordatorio sobre el documento memorandum que te enviamos: ${pdfLink}`;

                    return (
                        '<div class="btn-group">' +
                        '<a href="javascript:void(0)" class="btn-report btn btn-info" idDato="' +
                        data.id +
                        '" style="margin-right: 5px;"><i class="fa fa-file-text"></i></a>' +
                        '<a href="javascript:void(0)" class="btn-delete btn btn-danger" idDato="' +
                        data.id +
                        '"><i class="fa fa-trash"></i></a>' +
                        '<a href="https://wa.me/' +
                        telefono +
                        "?text=" +
                        encodeURIComponent(mensaje) +
                        '" class="btn btn-success" target="_blank" style="margin-left: 5px;"><i class="fa fa-whatsapp"></i></a>' +
                        '<a href="mailto:' +
                        email +
                        '" class="btn btn-warning" target="_blank" style="margin-left: 5px;"><i class="fa fa-envelope"></i></a>' +
                        "</div>"
                    );
                },
            },
        ],
    });

    $table.on("click", ".btn-report", function () {
        const id = $(this).attr("idDato");
        descargarPDF(id); // Llama a la función para descargar el PDF
    });

    function descargarPDF(id) {
        // Abre el PDF en una nueva pestaña
        window.open(`/auth/memorandum/generar-pdf/${id}`, "_blank");
    }

    $table.on("click", ".btn-delete", function () {
        const id = $(this).attr("idDato");
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/memorandum/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $dataTableMemorandum.ajax.reload(null, false);
            }
        );
    });
});
