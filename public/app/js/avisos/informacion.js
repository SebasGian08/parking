$(function(){

    const $postular = $("#postular"), $userInfo = $(".user-info");

    $postular.on("click", function(){
        const formData = new FormData();
        formData.append("_token", $("input[name=_token]").val());
        formData.append("aviso_id", $(this).attr("data-info"));
        actionAjax("/alumno/aviso/postular", formData, "POST", function(data){
            if(data.Success){
                $postular.text("Ya estas postulando").addClass("postulaste").prop("disabled", true);
                $("div.progress-line:first").addClass("active");
            }else{
                if(data.Redirect != null){
                    window.location.href = data.Redirect;
                }else{
                    swal("Error", "Invalid redirect", "error");
                }
            }
        });

    });

});
