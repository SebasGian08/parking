const PERFILES = {
    ADMINISTRADOR: 1,
};

const ESTADOS = {
    APROBADO: 1,
    CANCELADO: 0,
};

const TIPOS_ALUMNOS = {
    ALUMNO: 0,
    EGRESADO: 1,
    TITULADO: 2,
};

var pagination = false;

$(function () {
    $("#ModalCambiarPassword").on("click", function () {
        invocarModal("/auth/changePassword/partialView");
    });
});

$("body")
    .find("a")
    .on("click", function () {
        localStorage.setItem("cliente_id", "");
    });

$(document).on("click", "a.card-detail-notification", function () {
    const $id = $(this).attr("data-info").split("-")[1];
    localStorage.setItem("cliente_id", $id);
    window.location.href = "/";
});

try {
    window.addEventListener(
        "submit",
        function (e) {
            const form = e.target;
            if (form.getAttribute("enctype") === "multipart/form-data") {
                if (form.dataset.ajax) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    $(form)
                        .find("input[type=text]")
                        .each(function () {
                            if (this.inputmask)
                                this.inputmask._valueSet(
                                    this.inputmask.unmaskedvalue(),
                                    true
                                );
                        });
                    const xhr = new XMLHttpRequest();
                    xhr.open(form.method, form.action);

                    xhr.addEventListener("loadend", function () {
                        if (
                            form.getAttribute("data-ajax-loading") !== null &&
                            form.getAttribute("data-ajax-loading") !== ""
                        )
                            document.getElementById(
                                form.getAttribute("data-ajax-loading").substr(1)
                            ).style.display = "none";

                        if (
                            form.getAttribute("data-ajax-complete") !== null &&
                            form.getAttribute("data-ajax-complete") !== ""
                        )
                            window[
                                form.getAttribute("data-ajax-complete")
                            ].apply(this, []);
                    });

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200)
                                window[
                                    form.getAttribute("data-ajax-success")
                                ].apply(this, [JSON.parse(xhr.responseText)]);
                            else
                                window[
                                    form.getAttribute("data-ajax-failure")
                                ].apply(this, [xhr.status]);
                        }
                    };

                    const confirm = form.getAttribute("data-ajax-confirm");

                    if (confirm) {
                        swal(
                            {
                                title: "Confirmacion",
                                text: confirm,
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                            },
                            function () {
                                if (
                                    form.getAttribute("data-ajax-begin") !==
                                        null &&
                                    form.getAttribute("data-ajax-begin") !== ""
                                )
                                    window[
                                        form.getAttribute("data-ajax-begin")
                                    ].apply(this, []);

                                xhr.send(new FormData(form));
                            }
                        );
                    } else {
                        if (
                            form.getAttribute("data-ajax-loading") !== null &&
                            form.getAttribute("data-ajax-loading") !== ""
                        )
                            document.getElementById(
                                form.getAttribute("data-ajax-loading").substr(1)
                            ).style.display = "block";

                        if (
                            form.getAttribute("data-ajax-begin") !== null &&
                            form.getAttribute("data-ajax-begin") !== ""
                        )
                            window[form.getAttribute("data-ajax-begin")].apply(
                                this,
                                []
                            );

                        xhr.send(new FormData(form));
                    }
                }
            }
        },
        true
    );
} catch (err) {
    console.log(err);
}

try {
    toastr.options = {
        closeButton: true,
        debug: true,
        newestOnTop: true,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: true,
        showDuration: "1000",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut",
    };

    $.validator.setDefaults({
        ignore: [],
        // other default options
    });
} catch (err) {
    console.log(err);
}
$(function () {
    $(document).on("show.bs.modal", ".modal", function (event) {
        var zIndex = 1040 + 10 * $(".modal:visible").length;
        $(this).css("z-index", zIndex);
        setTimeout(function () {
            $(".modal-backdrop")
                .not(".modal-stack")
                .css("z-index", zIndex - 1)
                .addClass("modal-stack");
        }, 0);

        $("body").css("overflow", "hidden");
    });

    $(document).on("hidden.bs.modal", ".modal", function (event) {
        if ($(".modal.fade.in").length === 0) {
            $("body").css("overflow", "auto");
        }
    });

    const swalclose = window.swal.close;
    const swal = window.swal;
    window.swal = function () {
        const previousWindowKeyDown = window.onkeydown;
        swal.apply(this, Array.prototype.slice.call(arguments, 0));
        window.onkeydown = previousWindowKeyDown;
    };
    window.swal.close = function () {
        swalclose.apply(this);
    };

    $(document).on("keyup keypress", "form", function (e) {
        const keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $.ajaxSetup({ cache: false });
});
/* notification()
setInterval(notification, 60000);
function notification(){
    $.ajax({
        url: '/home/notification',
        type: "GET",
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#list_notification li').remove()
        },
        success: function (data) {
            $("#number_notify").html(data.countaviso)
            for (let i = 0; i < data.detailsaviso.length; i++) {
                $('#list_notification').append('<li class="li_notifi" onclick="redirectFunction()"><b style="font-weight:900">'+data.detailsaviso[i].titulo+'</b> aviso por activar de la empresa '+data.detailsaviso[i].empresas.ruc+'</li>');
            }
        }
    });
} */
/* notification();
setInterval(notification, 60000); */

/* function notification() {
    const now = moment().startOf("day");

    $.ajax({
        url: "/home/notification",
        type: "GET",
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $("#list_notification li").remove();
        },
        success: function (data) {
            $("#list_notification").empty();

            // Notificaciones de cumpleaños
            if (Object.keys(data.birthdayNotices).length > 0) {
                for (let daysLeft in data.birthdayNotices) {
                    let noticeData = data.birthdayNotices[daysLeft];

                    // Agregar notificaciones de cumpleaños
                    noticeData.forEach((person) => {
                        let daysRemaining = daysLeft === "0" ? "hoy" : daysLeft;
                        $("#list_notification").append(
                            '<li class="li_notifi">' +
                                '<i class="fa fa-birthday-cake" style="margin-right: 8px;"></i>' + // Icono de cumpleaños
                                "<b>" +
                                person.nombre +
                                " " +
                                person.apellido +
                                "</b> su cumpleaños es en : " +
                                daysRemaining +
                                " día!!!</li>"
                        );
                    });
                }
            } else {
                $("#list_notification").append(
                    '<li class="li_notifi">No tienes notificaciones de cumpleaños por ahora</li>'
                );
            }

            // Notificaciones de eventos
            if (data.eventsNotices.length > 0) {
                data.eventsNotices.forEach((event) => {
                    let eventDate = moment(event.fecha_registro);
                    let daysUntilEvent = eventDate.diff(now, "days");
                    $("#list_notification").append(
                        '<li class="li_notifi">' +
                            '<i class="fa fa-calendar" style="margin-right: 8px;"></i>' + // Icono de evento
                            "<b>" +
                            event.nombre +
                            "</b> es " +
                            (daysUntilEvent === 0
                                ? "hoy"
                                : daysUntilEvent + " días") +
                            ". responsable: " +
                            event.responsable +
                            "</li>"
                    );
                });
            } else {
                $("#list_notification").append(
                    '<li class="li_notifi">No tienes eventos próximos por ahora</li>'
                );
            }
        },
        error: function () {
            // Manejo de errores si la solicitud AJAX falla
            $("#list_notification").empty();
            $("#list_notification").append(
                '<li class="li_notifi">Error al cargar las notificaciones</li>'
            );
        },
    });
}
 */
function redirectFunction() {
    window.location.href = "aviso";
}

function invocarVista(url, onHiddenView) {
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        cache: false,
        success: function (data) {
            if (onHiddenView) onHiddenView(data);
        },
        beforeSend: function () {
            $("#loading").show();
        },
        complete: function () {
            $("#loading").hide();
        },
    });
}

function invocarModal(url, onHiddenModal) {
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
        cache: false,
        success: function (data) {
            const $modal = $("<div class='parent'>").append(data);
            $modal.find(">.modal").on("hidden.bs.modal", function () {
                if (onHiddenModal) onHiddenModal($(this));
                $(this).parent().remove();
            });
            $modal.find(">.modal").modal("show");

            $("body").append($modal);
        },
        beforeSend: function () {
            $("#loading").show();
        },
        complete: function () {
            $("#loading").hide();
        },
    });
}

function onSuccessForm(data, $form, $modal, onSucess, noreset) {
    if ($form != null) $form.find("span[data-valmsg-for]").text("");

    if (data.Success === true) {
        if (noreset == null) {
            $form.trigger("reset");
        }
        if ($modal) {
            $modal.attr("data-reload", "true");
        }
        swal(
            "Bien!",
            data.Message ? data.Message : "Registro/Guardado Correctamente",
            "success"
        );
        if ($modal) $modal.modal("hide");
        if (onSucess) onSucess(data);
    } else {
        if (data.Errors) {
            $.each(data.Errors, function (i, item) {
                if ($form != null) {
                    if (
                        $form.find("span[data-valmsg-for=" + i + "]").length !==
                        0
                    )
                        $form
                            .find("span[data-valmsg-for=" + i + "]")
                            .text(item[0]);
                }
            });
        }

        swal(
            "Algo Salio Mal!",
            data.Message ? data.Message : "Verifique los campos ingresados",
            "error"
        );
    }
}

function onFailureForm() {
    swal("Algo Salio Mal!", "Ocurrio un error al Guardar!!", "error");
}

function confirmAjax(
    url,
    parameters,
    type,
    msg,
    msgSuccess,
    onSuccess,
    onErrors
) {
    swal(
        {
            title: "Confirmación",
            text: msg ? msg : "¿ Está seguro ?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            actionAjax(
                url,
                parameters,
                type,
                onSuccess,
                true,
                msgSuccess,
                onErrors
            );
        }
    );
}
function confirmAjaxx(
    url,
    parameters,
    type,
    msg,
    msgSuccess,
    onSuccess,
    onErrors
) {
    swal(
        {
            title: "Calcular",
            text: msg ? msg : "¿ Está seguro de calcular el tiempo y monto total?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            actionAjax(
                url,
                parameters,
                type,
                onSuccess,
                true,
                msgSuccess,
                onErrors
            );
        }
    );
}

function actionAjax(
    url,
    parameters,
    type,
    onSuccess,
    isToConfirm,
    msgSuccess,
    onErrors
) {
    $.ajax({
        url: url,
        data: parameters,
        type: type != null ? type : "POST",
        cache: false,
        processData: false,
        contentType: false,
        success: function (data) {
            if (isToConfirm === true) {
                if (data.Success === true) {
                    swal(
                        "Bien!",
                        msgSuccess
                            ? msgSuccess
                            : "Proceso realizado Correctamente",
                        "success"
                    );
                    if (onSuccess) onSuccess(data);
                } else {
                    if (onErrors) onSuccess(data);
                    else swal("Algo Salio Mal!", data.Message, "error");
                }
            } else {
                if (onSuccess) onSuccess(data);
            }
        },
        beforeSend: function () {
            if (isToConfirm !== true) $("#loading").show();
        },
        complete: function () {
            if (isToConfirm !== true) $("#loading").hide();
        },
    });
}

function createModal(title, body, onHidden) {
    const template = `<div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">${title}</h4>
                          </div>
                          <div class="modal-body">
                            ${body}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>`;

    const $modal = $(template);
    $modal.on("hidden.bs.modal", function () {
        $modal.remove();
        if (onHidden) onHidden();
    });

    $modal.modal("show");
}

function getDate() {
    const now = new Date();
    const primerDia = new Date(now.getFullYear(), now.getMonth(), 1);
    const ultimoDia = new Date(now.getFullYear(), now.getMonth() + 1, 0);
    return {
        Now: now,
        FirstDay: primerDia,
        LastDay: ultimoDia,
    };
}

function isNumberKey(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;

    return true;
}

function agregarCommaMillions(data) {
    var str = data.toString().split(".");
    if (str[0].length >= 4) {
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, "$1,");
    }
    return str.join(".");
}

function getFormatDate(date) {
    const array = date.split("/");
    const f = new Date(array[2], array[1] - 1, array[0]);
    return f.format("yyyy-mm-dd");
}

function readImage(input, img) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            img.attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        img.attr("src", "/auth/layout/img/default.gif");
    }
}
