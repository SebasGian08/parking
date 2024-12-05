var $dataTableIP, $dataTable;
$(function(){

    const $table = $("#tableIP");

    $dataTableIP = $table.DataTable({
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": true,
        "lengthMenu": [[50,100,200,500,-1],[50,100,200,500,"Todo"]],
        "info": false,
        "buttons": [],
        "ajax": {
            url: "/auth/configuracion/list_all"
        },
        "columns": [
            { title: "ID", data: "id", className: "text-center" },
            { title: "IP ", data: "numero"},
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
                defaultContent:
                    "<button type='button' class='btn btn-secondary btn-xs btn-update' data-toggle='tooltip' title='Actualizar'><i class='fa fa-pencil'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            },
            {
                data: null,
                defaultContent:
                    "<button type='button' class='btn btn-danger btn-xs btn-delete' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash'></i></button>",
                "orderable": false,
                "searchable": false,
                "width": "26px"
            }
        ]
    });

    $table.on("click", ".btn-delete", function () {
        const id = $dataTableIP.row($(this).parents("tr")).data().id;
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', id);
        confirmAjax(`/auth/configuracion/delete`, formData, "POST", null, null, function () {
            $dataTableIP.ajax.reload(null, false);
        });
    });

    
    $table.on("click", ".btn-update", function () {
        const id = $dataTableIP.row($(this).parents("tr")).data().id;
        invocarModalView(id);
    });


    function invocarModalView(id) {
        invocarModal(`/auth/configuracion/partialView/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true") $dataTableIP.ajax.reload(null, false);
        });
    }
});
