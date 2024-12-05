var $dataTableAbonados, $dataTable;
$(function () {
    const $table = $("#tableAbonados");

    $dataTableAbonados = $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [],
        ajax: {
            url: "/auth/abonados/list_all",
        },
        columns: [
            { title: "ID", data: "id", className: "text-center" },
            {
                title: "TIPO DOCUMENTO",
                data: "tipo_documento.Nombre",
            },
            { title: "TIPO DOCUMENTO", data: "num_doc" },
            { title: "RAZON SOCIAL", data: "razon_social" },
            { title: "DIRECCION", data: "direccion" },
            { title: "TELEFONO", data: "tel" },
            { title: "EMAIL", data: "email" },
            { title: "OBSERVACIONES", data: "observaciones" },
            {
                title: "Estado",
                data: "estado",
                render: function (data) {
                    return data === 1 || data === "1"
                        ? "<span class='estado-activo'>Activo</span>"
                        : "<span class='estado-inactivo'>Inactivo</span>";
                },
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        "<div class='btn-group' role='group'>" +
                        "<a href='/auth/abonados/partialViewDetalle/" +
                        row.id +
                        "' class='btn btn-info btn-lg' data-toggle='tooltip' title='Ver Detalle'>" +
                        "<i class='fa fa-eye'></i>" +
                        "</a>" +
                        "<button type='button' class='btn btn-danger btn-lg btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>" +
                        "</div>"
                    );
                },
                orderable: false,
                searchable: false,
                width: "150px",
            },
        ],
    });

    $table.on("click", ".btn-update", function () {
        const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/abonados/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $dataTableAbonados.ajax.reload(null, false);
            }
        );
    });

    $("#modalRegistrarArea").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/abonados/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAbonados.ajax.reload(null, false);
            }
        );
    }

    $table.on("click", ".btn-view", function () {
        const id = $dataTableAbonados.row($(this).parents("tr")).data().id;
        invocarModalViewDetalle(id);
    });

    function invocarModalViewDetalle(id) {
        invocarModal(
            `/auth/abonados/partialViewDetalle/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAbonados.ajax.reload(null, false);
            }
        );
    }
});
