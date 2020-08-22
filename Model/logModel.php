<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }

    class logModel extends mainModel{
        protected function log_Model($dato){
            $sql = mainModel::conectar()->prepare("call valid_user(:Usuario);");
            $sql->bindParam(":Usuario",$dato);
            $sql->execute();

            return $sql;
        }
    }
?>