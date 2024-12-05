$(function () {
    const $table = $("#tableEmpleado");

    var $datatableEmpleado = $table.DataTable({
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
            url: "/auth/empleado/list_all",
            data: function (s) {
                // Aquí puedes añadir parámetros adicionales si es necesario
            },
        },
        columns: [
            {
                title: "N°",
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1; // Número de fila
                },
            },
            { 
                title: "", 
                data: "avatar_url", 
                class: "text-center",
                render: function(data) {
                    return '<img src="' + data + '" alt="Avatar" style="width:40px; height:40px; border-radius:50%;">';
                }
            },
            { title: "Nombre", data: "nombre", class: "text-center" },
            { title: "Apellido", data: "apellido", class: "text-center" },
            { title: "DNI", data: "dni", class: "text-center" },
            { title: "Teléfono", data: "tel", class: "text-center" },
            { title: "Email", data: "email", class: "text-center" },
            { title: "Cargo", data: "cargo.nombre", class: "text-center" }, // Mostrar el nombre del cargo
            { 
                title: "Horario", 
                data: null, 
                class: "text-center", 
                render: function(data, type, row) {
                    return `${row.horario.ingreso} - ${row.horario.salida}`;
                } 
            },
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
                render: function (data) {
                    return (
                        '<div class="btn-group">' +
                        '<a href="javascript:void(0)" class="btn-update btn btn-primary" idDato="' +
                        data.id +
                        '" style="margin-right: 5px;"><i class="fa fa-edit"></i></a>' +
                        '<a href="javascript:void(0)" class="btn-delete btn btn-danger" idDato="' +
                        data.id +
                        '" style="margin-right: 5px;"><i class="fa fa-trash"></i></a>' +
                        '<a href="javascript:void(0)" class="btn-generate-barcode btn btn-info" idDato="' +
                        data.id +
                        '"><i class="fa fa-barcode"></i></a>' +
                        "</div>"
                    );
                },
            },
        ],
    });

    $table.on("click", ".btn-generate-barcode", function () {
        var id = $(this).attr("idDato");
        var empleado = $datatableEmpleado.row($(this).parents("tr")).data();
        invocarModalViewCarnet(id);

    });

    function invocarModalViewCarnet(id) {
        invocarModal(
            `/auth/empleado/partialViewCarnet/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $datatableEmpleado.ajax.reload(null, false);
            }
        );
    }
    


    
    /* Para abrir modal y editar */
    $table.on("click", ".btn-update", function () {
        const id = $datatableEmpleado.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });

    function invocarModalView(id) {
        invocarModal(
            `/auth/empleado/partialView/${id ? id : 0}`,
            function ($modal) {
                if ($modal.attr("data-reload") === "true")
                    $datatableEmpleado.ajax.reload(null, false);
            }
        );
    }

    

    $table.on("click", ".btn-delete", function () {
        const id = $(this).attr("idDato");
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("id", id);
        confirmAjax(
            `/auth/empleado/delete`,
            formData,
            "POST",
            null,
            null,
            function () {
                $datatableEmpleado.ajax.reload(null, false);
            }
        );
    });
});
