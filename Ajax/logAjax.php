<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
        require_once "../Controller/logController.php";
        $insLog = new logController();
        if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
            echo $insLog->log_Controller();
        }
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'login/";</script>';
    }
?>