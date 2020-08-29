<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
    class productoController_l extends mainModel{
        public function listar_categoria(){
            $main = mainModel::consulta_simple("select nombre_cat_producto,cod_categoria from cat_producto");
            
            return $main;
        }
        public function listar_producto($codigo_p){
            $consulta = "select * from productos_index where cod_categoria ='".$codigo_p."';";
            $main = mainModel::consulta_simple($consulta);
            
            return $main;   
        }
    }
?>