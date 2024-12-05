var $tableVehiculos, $dataTable;
$(function () {
    const $table = $("#tableVehiculos");

    $tableVehiculos = $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [],
        ajax: {
            url: "/auth/vehiculos/list_all",
        },
        columns: [
            {
                title: "N°",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                },
            },
            { title: "Placa", data: "placa" },
            { title: "Tipo", data: "tipo.nombre" }, // Asegúrate de cargar 'tipo' en el modelo
            { title: "Modelo", data: "modelo" },
            { title: "Marca", data: "marca" },
            { title: "Color", data: "color" },
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
                width: "120px", // Ajusta el ancho de la columna para los botones grandes
            },
            
        ],
    });

    $table.on("click", ".btn-update", function () {
        const id = $tableVehiculos.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $tableVehiculos.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            "/auth/vehiculos/delete",
            formData,
            "POST",
            null,
            null,
            function () {
                $tableVehiculos.ajax.reload(null, false);
            }
        );
    });

    $("#modalRegistrarVehiculos").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/vehiculos/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $tableVehiculos.ajax.reload(null, false);
            }
        );
    }
});
