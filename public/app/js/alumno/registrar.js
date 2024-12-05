$(function(){

    const $fecha_nacimiento = $("#fecha_nacimiento");

    let anioActual = new Date().getFullYear() - 18;

    $fecha_nacimiento.datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        endDate: new Date("12-31-"+anioActual)
    });

    const $egresado_section = $(".egresado-section"), $egresado = $("#egresado"), $ciclo = $("#ciclo"), $semestre = $("#semestre");

});

$("#buscar_dni_alumno").click(function(){
/* $("#dni").keyup(function(){ */
    const dni = $("#dni");
    if($(dni).val().length >= 8){
        $.ajax({
            url: "https://istalcursos.edu.pe/apirest/alumnos",
            type: "POST",
            data: {documento : $(dni).val()},
            dataType : "json",
            beforeSend:function(){
		    	$("#nombres").attr('placeholder', "Buscando ...")
                $("#apellidos").attr('placeholder', "Buscando ...")
                $("#telefono").attr('placeholder', "Buscando ...")
                $("#email").attr('placeholder', "Buscando ...")
                $("#fecha_nacimiento").attr('placeholder', "Buscando ...")
		    },
            success: function (res) {
                $("#nombres").attr('placeholder', "Nombres")
                $("#apellidos").attr('placeholder', "Apellidos")
                $("#telefono").attr('placeholder', "Teléfono")
                $("#email").attr('placeholder', "Correo Electronico")
                $("#fecha_nacimiento").attr('placeholder', "Fecha de Nacimiento")
                if(res.success === true){
                    const data = res.data[0];
                    $("#nombres").val(data.NombreAlumno)
                    $("#apellidos").val(data.Apellidos)
                    $("#telefono").val(data.celular.replace(/ /g, ""))                  
                    $("#email").val(data.email)
                    $("#fecha_nacimiento").val( data.nacimiento )
                    $("#validationDni").html("Dni correcto.").removeClass("text-muted").removeClass("text-danger").addClass("text-success")
                    $(dni).removeClass("border-danger border-dark").addClass("border-success")
                    $("#btn-registrar").prop("disabled",false)
                }else{
                    swal("", "Usted no es Alumno de esta Institución", "warning");
                    $("#nombres").val("")
                    $("#apellidos").val("")
                    $("#telefono").val("")
                    $("#email").val("")
                    $("#fecha_nacimiento").val("")
                    $(dni).removeClass("border-success border-dark").addClass("border-danger")
                    $("#validationDni").html("El dni no existe en nuestros registros.").removeClass("text-muted").removeClass("text-success").addClass("text-danger")
                }
            }
        });
    }else{
        $("#nombres").val("")
        $("#apellidos").val("")
        $("#telefono").val("")
        $("#email").val("")
        $("#fecha_nacimiento").val("")
        $(dni).removeClass("border-success border-danger").addClass("border-dark")
        $("#validationDni").html("Ingrese su dni correcto para autocopletar su información.").removeClass("text-danger").removeClass("text-success").addClass("text-muted")
        $("#btn-registrar").prop("disabled",true)
    }
})