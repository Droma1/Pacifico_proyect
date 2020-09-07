<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['cod_cliente'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        
            echo $insAdmin->recarga_cliente();

    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'ClienteInicio";</script>';
    }
?>