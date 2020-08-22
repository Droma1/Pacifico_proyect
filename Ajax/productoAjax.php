<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['cod_producto'])){
        require_once "../Controller/productoController.php";
        $insP = new productoController();
        if(isset($_POST['cod_producto'])){
            echo $insP->Reg_producto_Controller();
        }
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'login/";</script>';
    }
?>