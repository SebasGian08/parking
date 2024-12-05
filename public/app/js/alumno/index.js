var OnSuccessActualizoPerfil, OnFailureActualizoPerfil;
$(function(){

    const $form = $('#actualizoPerfil'), $infoAdiciones = $(".info-adiciones a"), $egresado_section = $(".egresado-section");

    const $educacion = $("#content_educacion"), $experienciaLaboral = $("#content_experienciaLaboral"), $hoja_de_vida_content = $(".hoja_de_vida_content"),
    $referenciaLaboral = $("#content_referenciaLaboral"), $referenciaHabilidad = $("#referenciaHabilidad"), $referenciaHabilidadProfesional = $("#referenciaHabilidadProfesional"),
    $egresado = $("#egresado"), $ciclo = $("#ciclo"), $semestre = $("#semestre");

    const $imgContent = $('.imagen-perfil'), $img = $('.imagen-perfil > img'), $inputImg = $('#foto');

    const $fecha_nacimiento = $("#fecha_nacimiento");

    let anioActual = new Date().getFullYear() - 18;

    $fecha_nacimiento.datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        endDate: new Date("12-31-"+anioActual)
    });

    $("#hoja_de_vida").change(function (){
        var fileName = $(this).val().split('\\').pop();
        if(fileName != null && fileName != ""){
            $(".hoja_de_vida span.bold").text(fileName);
            swal("Bien", "Se ha cargado exiosamente su curriculum", "success");
        }else{
            $(".hoja_de_vida span.bold").text("Adjuntar mi CV");
            swal("Advertencia", "No hay ningún curriculum subido", "warning");
        }
    });

    $imgContent.on('click', function () {
        $inputImg.click();
    });

    $inputImg.change(function(){
        readImage(this, $img);
    });

    if(parseInt($egresado.val()) !== TIPO_ALUMNOS.TIPO_ALUMNO)
        $("#anio_egreso option[value='En Curso']").hide();

    $egresado.on("change", function(){
        if(parseInt($(this).val()) === TIPO_ALUMNOS.TIPO_ALUMNO){
            $("#anio_egreso option[value='En Curso']").show();
            $("#anio_egreso").val("En Curso").prop("disabled", true);
        }else{
            $("#anio_egreso option[value='En Curso']").hide();
            $("#anio_egreso").val("").prop("disabled", false);
        }
    });

    $infoAdiciones.on("click", function(){
        let url = null;
        switch($(this).attr("data-info")){
            case "agregarEducacion": url = "Educacion";break;
            case "agregarExperienciaLaboral": url = "ExperienciaLaboral";break;
            case "agregarReferenciaLaboral": url = "ReferenciaLaboral";break;
            case "agregarHabilidad": url = "Habilidad";break;
            case "agregarHabilidadProfesional": url = "HabilidadProfesional";break;
        }
        if(url != null)
            invocarModalView(null, url)
    })

    function invocarModalView(id, url) {
        invocarModal(`/alumno/perfil/partialView${url}/${id ? id : 0}`, function ($modal) {
            if ($modal.attr("data-reload") === "true"){
                if(url == "Educacion"){
                    reloadEducacion();
                }else if(url == "ExperienciaLaboral"){
                    reloadExperienciaLaboral();
                }else if(url == "ReferenciaLaboral"){
                    reloadReferenciaLaboral();
                }else if(url == "Habilidad"){
                    $referenciaHabilidad.html("");
                    actionAjax("/alumno/perfil/habilidades", null, "GET", function(data){
                        $.each(data.data, function(i, v){
                            if(v.habilidades.tipo == TIPO_HABILIDADES.PERSONAL){
                                $html += '<div class="col-md-3 mt-2">'+
                                '<p class="habilidad">'+v.habilidades.nombre+'</p>'+
                                '</div>';
                            }
                        });
                        $referenciaHabilidad.html($html);
                    });
                }else if(url == "HabilidadProfesional"){
                    $referenciaHabilidadProfesional.html("");
                    actionAjax("/alumno/perfil/habilidades", null, "GET", function(data){
                        $.each(data.data, function(i, v){
                            if(v.habilidades.tipo == TIPO_HABILIDADES.PROFESIONAL){
                                $html += '<div class="col-md-3 mt-2">'+
                                '<p class="habilidad">'+v.habilidades.nombre+'</p>'+
                                '</div>';
                            }
                        });
                        $referenciaHabilidadProfesional.html($html);
                    });
                }
            }
        });
    }


    function reloadEducacion(){
        let $html = '';
        $educacion.html("");
        actionAjax("/alumno/perfil/educaciones", null, "GET", function(data){
            $.each(data.data, function(i, v){
                console.log(v.estudio_fin)
                if(v.estado == "Estudiante"){
                    console.log(v.estado)
                    var etiq = '<p><b>Ciclo:</b> '+v.ciclo+'</p>'
                    var estado_estudiante = '<p><b>Estado del Estudiante:</b> '+v.estado_estudiante+'</p>'
                }else{
                    console.log("no es estudiante")
                    var etiq = '<p><b>Fin de Estudio:</b> '+v.estudio_fin+'</p>'
                    var estado_estudiante = ''
                }
                $html += '<div class="info-content">'+
                '<p><b>Institución:</b> '+v.institucion+'</p>'+
                '<p><b>Carrera/Cursodd:</b> '+v.areas.nombre+'</p>'+
                '<p><b>Estado:</b> '+v.estado+'</p>'+
                '<p><b>Inicio de Estudio:</b> '+v.estudio_inicio+'</p>'+
                etiq+
                estado_estudiante +
                '<ul class="btns-content">'+
                '<button type="button" class="btn btn-primary btn-xs" title="Editar" data-info-id="'+v.id+'"><i class="fa fa-pencil"></i></button>'+
                '<button type="button" class="btn btn-danger btn-xs" title="Eliminar" data-info-id="'+v.id+'"><i class="fa fa-trash"></i></button>'+
                '</ul>'
                '</div>';
            });
            $educacion.html($html);
        });
    }

    function reloadExperienciaLaboral(){
        let $html = '';
        $experienciaLaboral.html("");
        actionAjax("/alumno/perfil/experiencias", null, "GET", function(data){
            console.log("esta es la dat de las experiencias laborales : ", data)
            $.each(data.data, function(i, v){
                if(v.estado == null || v.estado== ""){
                    etd = ""
                }else{
                    etd ="<p><b>Estado:</b> "+v.estado+"</p>"
                }
                if(v.fin_laburo == null || v.fin_laburo == ""){
                    badas = ""
                }else{
                    badas = "<p><b>Fin del Laburo:</b>"+v.fin_laburo+"</p>"
                }
                $html += '<div class="info-content">'+
                '<p><b>Puesto:</b> '+v.puesto+'</p>'+
                '<p><b>Empresa:</b> '+v.empresa+'</p>'+
                '<p><b>Sector:</b> '+v.sector+'</p>'+
                etd+
                '<p><b>Inicio del Laburo:</b> '+v.inicio_laburo+'</p>'+
                badas+
                '<p><b>Funciones desempeñadas:</b> <br> '+v.descripcion+'</p>'+
                '<ul class="btns-content">'+
                '<button type="button" class="btn btn-primary btn-xs" title="Editar" data-info-id="'+v.id+'"><i class="fa fa-pencil"></i></button>'+
                '<button type="button" class="btn btn-danger btn-xs" title="Eliminar" data-info-id="'+v.id+'"><i class="fa fa-trash"></i></button>'+
                '</ul>'
                '</div>';
            });
            $experienciaLaboral.html($html);
        });
    }

    function reloadReferenciaLaboral(){
        let $html = '';
        $referenciaLaboral.html("");
        actionAjax("/alumno/perfil/referencias", null, "GET", function(data){
            $.each(data.data, function(i, v){
                if(v.fin_curso == null || v.fin_curso == ""){
                    badas = ""
                }else{
                    badas = "<p><b>Fin del Curso:</b>"+v.fin_curso+"</p>"
                }
                if(v.estado == null || v.estado== ""){
                    etd = ""
                }else{
                    etd ="<p><b>Estado:</b> "+v.estado+"</p>"
                }
                $html += '<div class="info-content">'+
                '<p><b>Nombre del Curso:</b> '+v.name_curso+'</p>'+
                '<p><b>Institución:</b> '+v.institucion+'</p>'+
                etd+
                '<p><b>Inicio del Curso:</b> '+v.inicio_curso+'</p>'+
                badas+
                '<ul class="btns-content">'+
                '<button type="button" class="btn btn-primary btn-xs" title="Editar" data-info-id="'+v.id+'"><i class="fa fa-pencil"></i></button>'+
                '<button type="button" class="btn btn-danger btn-xs" title="Eliminar" data-info-id="'+v.id+'"><i class="fa fa-trash"></i></button>'+
                '</ul>'
                '</div>';
            });
            $referenciaLaboral.html($html);
        });
    }

    $form.on('submit', function (e) {
        e.preventDefault();
        /* Se comento esto para que pueda guardar */
        /* for(var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        } */
        const formData = new FormData($(this)[0]);
        actionAjax("/alumno/perfil", formData, "POST", function(data){
            onSuccessForm(data, $form, null, true, function(){
                if(data.Success){

                    let $html = "";

                    $(".content-perfil img").attr("src", (data.Alumno.foto != null && data.Alumno.foto != "" ? "/uploads/alumnos/fotos/"+data.Alumno.foto : "/uploads/default.png"));
                    $(".content-perfil a").attr("href", "/uploads/alumnos/archivos/"+data.Alumno.hoja_de_vida);
                    $(".content-perfil .alumno_edad").text(data.Edad + " años");

                    if(data.Alumno.hoja_de_vida != null && data.Alumno.hoja_de_vida != ""){
                        $html += '<a href="/uploads/alumnos/archivos/'+data.Alumno.hoja_de_vida+'" target="_blank">Cv' + data.Alumno.nombres + " " + data.Alumno.apellidos +'</a>';
                        $html += '<div class="hoja_de_vida"><p>Editar mi CV <br> <span>(*.pdf, *.doc)</span></p>';
                        $html += '<input type="file" class="styled form-control" name="hoja_de_vida" id="hoja_de_vida" accept="application/pdf, application/msword, .doc, .docx"></div>';
                    }else{
                        $html += '<div class="hoja_de_vida"><p>Adjuntar mi CV <br> <span>(*.pdf, *.doc)</span></p>';
                        $html += '<input type="file" class="styled form-control" name="hoja_de_vida" id="hoja_de_vida" accept="application/pdf, application/msword, .doc, .docx" required></div>';
                    }

                    $hoja_de_vida_content.html($html);

                    setTimeout(function(){
                        window.location.href = "/alumno/perfil";
                    }, 1000)
                }
            });
        });
    });

    $educacion.on("click", ".btn-primary", function(){
        const $id = $(this).attr("data-info-id");
        invocarModalView($id, "Educacion");
    });

    $educacion.on("click", ".btn-danger", function(){
        const $id = $(this).attr("data-info-id");
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', $id);
        confirmAjax(`/alumno/perfil/educacion/delete`, formData, "POST", null, null, function () {
            reloadEducacion();
        });
    });


    $experienciaLaboral.on("click", ".btn-primary", function(){
        const $id = $(this).attr("data-info-id");
        invocarModalView($id, "ExperienciaLaboral");
    });

    $experienciaLaboral.on("click", ".btn-danger", function(){
        const $id = $(this).attr("data-info-id");
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', $id);
        confirmAjax(`/alumno/perfil/experiencia/delete`, formData, "POST", null, null, function () {
            reloadExperienciaLaboral();
        });
    });


    $referenciaLaboral.on("click", ".btn-primary", function(){
        const $id = $(this).attr("data-info-id");
        invocarModalView($id, "ReferenciaLaboral");
    });

    $referenciaLaboral.on("click", ".btn-danger", function(){
        const $id = $(this).attr("data-info-id");
        const formData = new FormData();
        formData.append('_token', $("input[name=_token]").val());
        formData.append('id', $id);
        confirmAjax(`/alumno/perfil/referencia/delete`, formData, "POST", null, null, function () {
            reloadReferenciaLaboral();
        });
    });


    function ObtenerNombreMes($mes)
    {
        $nombre = "";

        switch ($mes){
            case 1 : $nombre = "Enero"; break;
            case 2 : $nombre = "Febrero"; break;
            case 3 : $nombre = "Marzo"; break;
            case 4 : $nombre = "Abril"; break;
            case 5 : $nombre = "Mayo"; break;
            case 6 : $nombre = "Junio"; break;
            case 7 : $nombre = "Julio"; break;
            case 8 : $nombre = "Agosto"; break;
            case 9 : $nombre = "Setiembre"; break;
            case 10 : $nombre = "Octubre"; break;
            case 11 : $nombre = "Noviembre"; break;
            case 12 : $nombre = "Diciembre"; break;
        }

        return $nombre;
    }

    actionAjax("/alumno/perfil/validacion", null, "GET", function(data){
        if(data.Errors > 0){
            swal("Advertencia", "Para postular a un empleo complete todo los campos", "warning");
        }
    });

    OnFailureActualizoPerfil = () => onFailureForm();
});
