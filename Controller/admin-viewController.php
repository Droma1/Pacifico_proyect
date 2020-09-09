<?php
        if($peticionAjax){
            require_once "../Config/main.php";
        }else{
            require_once "./Config/main.php";
        }

        class AdminViewController extends mainModel{

            public function procesar_recarga(){
                $codigo = $_POST['codigo_cliente_recarga'];
                $monto = $_POST['monto'];
                $id_recarga = $_POST['id_recarga'];

                $estado_r = mainModel::consulta_simple("call process_recarga('".$codigo."',".$monto.",".$id_recarga.");");

                if($estado_r->rowCount()>0){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Proceso Exitoso!",
                        "texto" => "Se Acepto la recarga del cliente Exitosamente..",
                        "tipo" => "Completo!",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Procesado!",
                        "texto" => "Falla al comprobar la recarga, ya se realizó el proceso de la recarga o se genero errores con el servicio..",
                        "tipo" => "Error!",
                        "clase" => "danger"
                    ];
                }

                return mainModel::alerts($alerta);
            }

            public function listar_cliente(){
                $sql = mainModel::consulta_simple("select * from lista_cliente_r");

                return $sql;
            }

            public function perfil($codigo){
                $sql = mainModel::consulta_simple("select * from perfil_admi where cod_admin = '".$codigo."';");

                return $sql;
            }
            
        }

?>