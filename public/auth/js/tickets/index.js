var $table; // Define la variable para la tabla
$(function () {
    $table = $("#tableTickets"); // Asocia la tabla con la variable

    $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [],
        ajax: {
            url: "/auth/tickets/list_all",
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
                title: "VEHICULO",
                render: function (data, type, row) {
                    return row["vehiculo.placa"];
                },
            },
            {
                title: "TIPO VEHICULO",
                render: function (data, type, row) {
                    return row["vehiculo.tipo.nombre"];
                },
            },
            {
                title: "TARIFA",
                render: function (data, type, row) {
                    return row["vehiculo.tipo.montoxhora"];
                },
            },
            {
                title: "TIEMPO INICIO",
                data: "tiempo_inicio",
                render: (data) => {
                    if (!data) {
                        return null;
                    }
                    return data;
                },
            },
            {
                title: "USER",
                render: function (data, type, row) {
                    return row["user.nombres"];
                },
            },

            {
                title: "TIEMPO FIN",
                data: "tiempo_fin",
                render: (data) => {
                    if (!data) {
                        return null;
                    }
                    return data;
                },
            },
            {
                title: "HORAS DE SERVICIO",
                data: "tiempo_fin",
                render: (data) => {
                    if (!data) {
                        return "1h:0m";
                    }
                    const fecha = new Date(data);
                    const hours = fecha.getHours();
                    const minutes = fecha.getMinutes();
                    return `${hours}h:${minutes}m`;
                },
            },
            {
                title: "Monto Total",
                data: "monto",
                render: (data) => {
                    if (!data) {
                        return "S/"+ "0";
                    }
                    return "S/" + data; // Se coloca el prefijo "S/" antes del valor de "monto"
                }
            },
            
            {
                title: "Estado",
                data: "estado",
                render: function (data) {
                    return data === 1 || data === "1"
                        ? "<span class='estado-activo'>Activo</span>"
                        : "<span class='estado-inactivo'>Cerrado</span>";
                },
            },
            {
                data: null,
                defaultContent:
                    "<div class='btn-group' role='group'>" +
                    "<button type='button' class='btn btn-warning btn-lg btn-preview-time' data-toggle='tooltip' title='Previsualizar Hora'><i class='fa fa-hourglass'></i></button>" +
                    "<button type='button' class='btn btn-info btn-lg btn-calculate' data-toggle='tooltip' title='Calcular'><i class='fa fa-calculator'></i></button>" +
                    "<button type='button' class='btn btn-secondary btn-lg btn-update' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>" +
                    "<button type='button' class='btn btn-danger btn-lg btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>" +
                    "</div>",
                orderable: false,
                searchable: false,
                width: "160px",
            },
        ],
        rowCallback: function (row, data) {
            if (data.estado === 2) {
                // Si el estado es "Cerrado"
                $(row).addClass("bloqueado"); // Añadimos la clase 'bloqueado' a la fila
                $(row).find("button").prop("disabled", true); // Deshabilitar los botones en la fila
            }
        },
    });
    $("#btn-consultar").on("click", function () {
        // Obtener los valores de los filtros
        var desde = $("#desde").val(); // Suponiendo que el filtro de fecha "Desde" tiene el id "desde"
        var hasta = $("#hasta").val(); // Suponiendo que el filtro de fecha "Hasta" tiene el id "hasta"
        var estado = $("#estado").val(); // Suponiendo que el filtro de estado tiene el id "estado"

        // Recargar la tabla con los filtros aplicados
        $table
            .DataTable()
            .ajax.url(
                "/auth/tickets/list_all?desde=" +
                    desde +
                    "&hasta=" +
                    hasta +
                    "&estado=" +
                    estado
            )
            .load();
    });

    $table.on("click", ".btn-update", function () {
        const id = $table.DataTable().row($(this).parents("tr")).data().id; // Cambio de $tableTickets a $table
        invocarModalView(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $table.DataTable().row($(this).parents("tr")).data().id; // Cambio de $tableTickets a $table
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/tickets/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $table.DataTable().ajax.reload(null, false); // Cambio de $tableTickets a $table
            }
        );
    });

    $("#modalRegistrarTickets").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/tickets/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $table.DataTable().ajax.reload(null, false); // Cambio de $tableTickets a $table
            }
        );
    }

    /* PREVISUALIZAR */
    $table.on("click", ".btn-preview-time", function () {
        const id = $table.DataTable().row($(this).parents("tr")).data().id;
        invocarModalViewCalculate(id);
    });

    function invocarModalViewCalculate(id) {
        invocarModal(
            `/auth/tickets/partialViewCalculate/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $table.DataTable().ajax.reload(null, false);
            }
        );
    }
    /* FIN PREVISUALIZAR */

    /* CALCULAR  Y GUARDAR EN BD*/
    $table.on("click", ".btn-calculate", function () {
        const id = $table.DataTable().row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjaxx(
            `/auth/tickets/confirmar`,
            formData,
            "POST",
            null,
            null,
            function () {
                $table.DataTable().ajax.reload(null, false); // Cambio de $tableTickets a $table
            }
        );
    });
    /* FIN CALCULAR  */
    
    $("#modalRegistrarVehiculos").on("click", function () {
        invocarModalViewVehiculos();
    });

    function invocarModalViewVehiculos(id) {
        invocarModal(
            `/auth/vehiculos/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $tableVehiculos.ajax.reload(null, false);
            }
        );
    }

});
