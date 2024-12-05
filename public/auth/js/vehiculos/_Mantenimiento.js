var OnSuccessRegistroVehiculos, OnFailureRegistroVehiculos;
$(function(){

    const $modal = $("#modalMantenimientoVehiculos"), $form = $("form#registroVehiculos");

    OnSuccessRegistroVehiculos = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroVehiculos = () => onFailureForm();
});
