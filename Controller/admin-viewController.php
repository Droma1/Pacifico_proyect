<?php
        if($peticionAjax){
            require_once "../Config/main.php";
        }else{
            require_once "./Config/main.php";
        }

        class AdminViewController extends mainModel{

            public function perfil($codigo){
                $sql = mainModel::consulta_simple("select * from perfil_admi where cod_admin = '".$codigo."';");

                return $sql;
            }
            
        }

?>