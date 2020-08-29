<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
    class productoController_l extends mainModel{
        public function listar_categoria(){
            $main = mainModel::consulta_simple("select nombre_cat_producto from cat_producto");
            
            return $main;
        }
        public function listar_producto(){
            $main = mainModel::consulta_simple("select * from producto_index;");
            
            return $main;   
        }
    }
?>