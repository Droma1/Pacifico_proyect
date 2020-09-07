<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['pass_edit'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        
            echo $insAdmin->edit_cliente();

    }else{
        session_start();
        session_destroy();
        echo '<script>window.location.href="'.SERVERURL.'login/";</script>';
    }
?>