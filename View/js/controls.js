$(document).ready(function(){
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
});

