var OnSuccessRegistroAsistencia, OnFailureRegistroAsistencia;
$(function(){

    const $modal = $("#modalMantenimientoAsistencia"), $form = $("form#registroAsistencia");

    OnSuccessRegistroAsistencia = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroAsistencia = () => onFailureForm();
});
