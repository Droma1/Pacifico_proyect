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
        }
?>