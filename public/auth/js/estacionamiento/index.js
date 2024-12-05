var $tableEstacionamiento, $dataTable;
$(function () {
    const $table = $("#tableEstacionamiento");

    $tableEstacionamiento = $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [],
        ajax: {
            url: "/auth/estacionamiento/list_all",
        },
        columns: [
            {
                title: "N°",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            { title: "Codigo", data: "codigo" },
            { title: "Numero", data: "numero" },
            { title: "Piso", data: "piso" },
           /*  { title: "Perfil", data: "profile.name", className: "text-center" }, */
            { title: "Observaciones", data: "observaciones" },
            {
                title: "Estado",
                data: "estado",
                render: function (data) {
                    return data === 1 || data === '1'
                        ? "<span class='estado-activo'>Activo</span>"
                        : "<span class='estado-inactivo'>Inactivo</span>";
                },
            },
            {
                data: null,
                defaultContent:
                    "<div class='btn-group' role='group'>" +
                        "<button type='button' class='btn btn-secondary btn-lg btn-update' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>" +
                        "<button type='button' class='btn btn-danger btn-lg btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>" +
                    "</div>",
                orderable: false,
                searchable: false,
                width: "80px", // Ajusta el ancho de la columna para los botones grandes
            },
        ],
    });

    $table.on("click", ".btn-update", function () {
        const id = $tableEstacionamiento.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $tableEstacionamiento.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/estacionamiento/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $tableEstacionamiento.ajax.reload(null, false);
            }
        );
    });

    $("#modalRegistrarEstablecimiento").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/estacionamiento/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $tableEstacionamiento.ajax.reload(null, false);
            }
        );
    }
});
