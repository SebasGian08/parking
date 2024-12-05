var $dataTableAviso, $dataTable;
function consultarEmpleador() {
    $("#btn_mostrar").attr("mostrar", "");
    $dataTableAviso.ajax.reload();
}

$(function () {
    /* Para que se active el modal */
    $(".btn_evento_bolsa").click();
    /* Fin */
    /* console.log("cambiado"); */
    const $table = $("#tableAviso");
    var hoy = new Date();
    var año = hoy.getFullYear();
    var mes = ("0" + (hoy.getMonth() + 1)).slice(-2);
    var dia = ("0" + hoy.getDate()).slice(-2);
    var fecha_actual = año + "-" + mes + "-" + dia;
    // Asignar fecha inicial deseada
  

    // Luego, asignar ese valor a tu variable $fecha_desde (suponiendo que $fecha_desde es un input de tipo date o text)
    const $fecha_desde = $("#fecha_desde");
    const $fecha_hasta = $("#fecha_hasta");

    // DataTable initialization con AJAX
    $dataTableAviso = $table.DataTable({
        stripeClasses: ["odd-row", "even-row"],
        lengthChange: true,
        lengthMenu: [
            [50, 100, 200, 500, -1],
            [50, 100, 200, 500, "Todo"],
        ],
        info: false,
        buttons: [],
        ajax: {
            url: "/empresa/avisos/listar_json",
            data: function (params) {
                // Verificar si hay fecha desde seleccionada
                if ($fecha_desde.val() !== "") {
                    params.fecha_desde = $fecha_desde.val();
                } else {
                    delete params.fecha_desde; // Borrar el parámetro si no hay fecha desde
                }

                // Verificar si hay fecha hasta seleccionada
                if ($fecha_hasta.val() !== "") {
                    params.fecha_hasta = $fecha_hasta.val();
                } else {
                    delete params.fecha_hasta; // Borrar el parámetro si no hay fecha hasta
                }
            },
        },

        columns: [
            { title: "Fecha de Registro", data: "created_at" },
            { title: "Titulo", data: "titulo" },
            // { title: "Modalidad", data: "modalidades.nombre", class: ""},
            // { title: "Horario", data: "horarios.nombre", class: ""},
            {
                title: "Distrito",
                data: "distritos.nombre",
                render: function (data) {
                    if (data) {
                        return data;
                    }
                    return "-";
                },
            },
            /* { title: "Salario", data: "salario"}, Se saco */
            {
                title: "Estado",
                data: null,
                render: function (data) {
                    if (data.estado_aviso == 0) {
                        return "<span style='font-weight:900;'>En Revisión</span>";
                    } else {
                        if (data.periodo_vigencia < fecha_actual) {
                            return "<span style='font-weight:900;'>caducado</span>";
                        } else {
                            return "<span class='text-success' style='font-weight:900;'>activo</span>";
                        }
                    }
                },
                orderable: false,
                searchable: false,
                width: "26px",
            },
            {
                title: "Postulantes", // Título de la columna (si estás usando DataTables con título de columna)
                data: null, // No hay datos específicos para esta columna (puede estar vacío o no definido)
                render: function (data) {
                    // Verificar si data está definido correctamente y tiene la propiedad necesaria
                    if (
                        !data ||
                        typeof data.id === "undefined" ||
                        typeof data.empresas === "undefined" ||
                        typeof data.empresas.id === "undefined"
                    ) {
                        return ""; // Retornar cadena vacía si los datos no son válidos
                    }

                    // Construir el HTML del botón para ver postulantes
                    return `
                        <div class='text-center'>
                            <a href="/empresa/${data.empresas.id}/aviso/${data.id}/postulantes/"
                               class="btn btn-primary btn-xs" style="font-size:11px;"
                               data-toggle="tooltip"
                               title="Ver postulantes para este aviso">
                                <i class="fa fa-users"></i> Ver
                            </a>
                        </div>
                    `;
                },
                orderable: false, // No se puede ordenar por esta columna
                searchable: false, // No se puede buscar en esta columna
                width: "26px", // Ancho de la columna
            },
            /* {
                title: "Editar", // Título de la columna (si estás usando DataTables con título de columna)
                data: null, // No hay datos específicos para esta columna (puede estar vacío o no definido)
                render: function (data) {
                    return (
                        "<div class='text-center'>" + // Div para centrar contenido
                        "<button type='button' class='btn btn-warning " +
                        (data.periodo_vigencia < fecha_actual
                            ? ""
                            : "btn-update") +
                        " btn-xs' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>" +
                        "</div>"
                    );
                },
                orderable: false, // No se puede ordenar por esta columna
                searchable: false, // No se puede buscar en esta columna
                width: "26px", // Ancho de la columna
            }, */
            {
                title: "Vacante Publicada", // Título de la columna (si estás usando DataTables con título de columna)
                data: null, // No hay datos específicos para esta columna (puede estar vacío o no definido)
                render: function (data) {
                    return (
                        "<div class='text-center'>" + // Div para centrar contenido
                        "<a href='/empresa/" +
                        data.empresas.id +
                        "/aviso/" +
                        data.id +
                        "' style='padding: 5px; font-size: 12px;' class='btn btn-secondary btn-xs' data-toggle='tooltip' title='Ver mas'><i class='fa fa-info-circle'></i> Ver</a>" +
                        "</div>"
                    );
                },
                orderable: false, // No se puede ordenar por esta columna
                searchable: false, // No se puede buscar en esta columna
                width: "26px", // Ancho de la columna
            },
            {
                title: "Republicar", // Título de la columna (si estás usando DataTables con título de columna)
                data: null, // No hay datos específicos para esta columna (puede estar vacío o no definido)
                defaultContent:
                    "<div class='text-center'>" + // Div para centrar contenido
                    "<button type='button' class='btn btn-success btn-xs btn-republicar' data-toggle='tooltip' title='Republicar'><i class='fa fa-refresh'></i></button>" +
                    "</div>",
                orderable: false, // No se puede ordenar por esta columna
                searchable: false, // No se puede buscar en esta columna
                width: "26px", // Ancho de la columna
            },
        ],
        rowCallback: function (row, data, index) {
            if (data.periodo_vigencia < fecha_actual) {
                $("td", row).css({
                    "background-color": "#f87171",
                    color: "#fff",
                });
            } else if (data.estado_aviso == 0) {
                $("td", row).css({
                    "background-color": "#F8C471",
                    color: "#fff",
                });
            }
        },
    });

    $table.on("click", ".btn-update", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    $table.on("click", ".btn-republicar", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModalView2(id);
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/empresa/avisos/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $dataTableAviso.ajax.reload(null, false);
            }
        );
    });

    $("#modalRegistrarAviso").on("click", function () {
        invocarModalView();
    });

    function invocarModalView(id) {
        invocarModal(
            `/empresa/avisos/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAviso.ajax.reload(null, false);
            }
        );
    }

    function invocarModalView2(id) {
        invocarModal(
            `/empresa/avisos/partialView2/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAviso.ajax.reload(null, false);
            }
        );
    }

    $table.on("click", ".btn-see", function () {
        const id = $dataTableAviso.row($(this).parents("tr")).data().id;
        invocarModal(
            `/empresa/avisos/partialViewPostulante/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $dataTableAviso.ajax.reload(null, false);
            }
        );
    });
});
