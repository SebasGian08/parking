var OnSuccessRegistroHabilidad, OnFailureRegistroHabilidad;
$(function(){

    const $modal = $("#modalMantenimientoHabilidad"), $form = $("form#registroHabilidad");

    const $habilidades = $("#habilidades");

    $habilidades.select2({
        allowClear: true
    });

    if ($habilidades.attr("data-initial").length !== 0) {
        $habilidades.val($habilidades.attr("data-initial").split(",")).trigger("change");
    }

    OnSuccessRegistroHabilidad = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroHabilidad = () => onFailureForm();
});
