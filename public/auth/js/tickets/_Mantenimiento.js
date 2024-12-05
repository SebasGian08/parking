var OnSuccessRegistroTickets, OnFailureRegistroTickets;
$(function(){

    const $modal = $("#modalMantenimientoTickets"), $form = $("form#registroTickets");

    OnSuccessRegistroTickets= (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroTickets = () => onFailureForm();
});



$("#modalRegistrarCliente").on("click", function () {
    invocarModalView();
});

function invocarModalView(id) {
    invocarModal(
        `/auth/vehiculos/partialView/${id ? id : 0}`,
        function ($modal) {
            if ($modal.attr("data-reload") === "true") {
                // El código de recarga de la tabla se elimina
            }
        }
    );
}
