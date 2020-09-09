<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['cod_cliente'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        
            echo $insAdmin->recarga_cliente();

    }elseif(isset($_POST['codigo_cliente_recarga'])){
        require_once "../Controller/admin-viewController.php";
        $insAdmin = new AdminViewController();
        
            echo $insAdmin->procesar_recarga();
    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'ClienteInicio";</script>';
    }
?>