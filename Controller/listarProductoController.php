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
            $consulta = "select * from productos_index where cod_categoria ='".$codigo_p."' and estado_venta = 'VIGENTE';";
            $main = mainModel::consulta_simple($consulta);
            
            return $main;   
        }
        public function promociones(){
            $promotions = mainModel::consulta_simple("select * from promocion_producto;");
            return $promotions;
        }
        public function producto_view($cod_producto){
            $producto_complete = mainModel::consulta_simple("select * from producto_view where cod_producto = '".$cod_producto."';");
            return $producto_complete;
        }
    }
?>