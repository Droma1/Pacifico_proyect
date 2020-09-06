<?php
        if($peticionAjax){
            require_once "../Config/main.php";
        }else{
            require_once "./Config/main.php";
        }

        class clientController extends mainModel{
            public function perfil_cliente($codigo){
                $perfil = mainModel::consulta_simple("select * from perfil_cliente where cod_cliente = '".$codigo."';");
                return $perfil;
            }
            public function contador_compras($codigo){
                $contador = mainModel::consulta_simple("select * from contador_compras where cod_cliente = '".$codigo."';");
                return $contador;
            }
            public function contador_recargas($codigo){
                $recargas = mainModel::consulta_simple("select * from contador_recargas where cod_cliente = '".$codigo."';");
                return $recargas;
            }
            public function mis_compras($codigo){
                $compras = mainModel::consulta_simple("select * from compras where cod_cliente = '".$codigo."';");
                return $compras;
            }
            public function productos_compras($codigo,$estado){
                if($estado == "PROCESO"){
                    $productos = mainModel::consulta_simple("select * from lista_compras where estado_compra = '".$estado
                    ."' and cod_cliente = '".$codigo."';");
                }else{
                    $productos = mainModel::consulta_simple("select * from lista_compras_c where cod_cliente = '".$codigo."';");
                }
               return $productos; 
            }
            public function recargas($codigo){
                $recargas = mainModel::consulta_simple("select * from recargas where cod_cliente = '".$codigo."';");
                return $recargas;
            }
        }
?>