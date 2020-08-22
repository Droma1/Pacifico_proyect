<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['dni_cliente'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        if(isset($_POST['dni_cliente']) && isset($_POST['nombre_cliente']) && isset($_POST['apellido_cliente']) && isset($_POST['email_cliente'])){
            echo $insAdmin->add_cliente_controller();
        }
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'login/";</script>';
    }
?>