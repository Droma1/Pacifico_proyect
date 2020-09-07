<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['cod_producto'])){
        require_once "../Controller/productoController.php";
        $insP = new productoController();
        if(isset($_POST['cod_producto'])){
            echo $insP->Reg_producto_Controller();
        }
    }elseif(isset($_POST['codigo_e'])){
        require_once "../Controller/productoController.php";
        $editar = new productoController();
        echo $editar->estado_prod();

    }elseif(isset($_POST['codigo_cambiar'])){
        require_once "../Controller/productoController.php";
        $editar = new productoController();
        echo $editar->estado_prod_v();
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'login";</script>';
    }
?>