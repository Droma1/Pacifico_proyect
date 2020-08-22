$(document).ready(function(){
		$('.categories').click(function(){
            $('.menos').css("transform","rotate(90deg)");
			if($('.items-category').css("display") == "none"){
				$('.items-category').slideDown(100);
			}else{
				$('.items-category').slideUp(100);
			}
		});
	

    $("#eye2").hide();
    $("#text_eye2").hide();

    $("#eye").click(function(){
        $("#pass").prop("type","text");
        $(this).hide();
        $("#text_eye").hide();
        $("#eye2").show();
        $("#text_eye2").show();
    });
    $("#eye2").click(function(){
        $("#pass").prop("type","password");
        $(this).hide();
        $("#text_eye2").hide();
        $("#eye").show();
        $("#text_eye").show();
    });
$('.btn_list').click(function(){
    if ($('.users_list').css("display") == "none") {
        $('.users_list').slideDown(100);
    }else{
        $('.users_list').slideUp(100);
    }
});
$('.cat_existente').hide();
$('.cat_new_input').hide();
$('.new_name').hide();
$('.new_descrip').hide();
$('.cat_new').click(function(){
    $('.cat_existente').show();
    $('.cat_new_input').show();
    $('.cat_new').hide();
    $('.cat_existente_select').hide();
    $('.new_name').show();
    $('.new_descrip').show();
});
$('.cat_existente').click(function(){
    $('.cat_new').show();
    $('.cat_existente_select').show();
    $('.cat_existente').hide();
    $('.cat_new_input').hide();
    $('.new_name').hide();
    $('.new_descrip').hide();
});

 $('.formAjax').submit(function(e){
        e.preventDefault();

        var form=$(this);

        var tipo=form.attr('data-form');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');

        var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);
 

        var textoAlerta;
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }

        $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                    respuesta.html(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
        /*swal({
            title: "¿Estás seguro?",   
            text: textoAlerta,   
            type: "question",   
            showCancelButton: true,     
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar"
        }).then(function () {
            
            return false;
        });*/
    });

});
