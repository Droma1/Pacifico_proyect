<?php
    $peticionAjax = true;
    require_once "../Config/configGeneral.php";
    if(isset($_POST['pass_edit'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        
            echo $insAdmin->edit_cliente();

    }elseif(isset($_POST['saldo_c'])){
        require_once "../Controller/clienteController.php";
        $insAdmin = new clienteController();
        
            echo $insAdmin->comprar();
    }else{
        echo '<script>window.location.href="'.SERVERURL.'login/";</script>';
    }
?>