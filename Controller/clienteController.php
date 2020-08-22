<?php
    if($peticionAjax){
        require_once "../Model/clienteModel.php";
    }else{
        require_once "./Model/clienteModel.php";
    }

    class clienteController extends clienteModel{
        public function add_cliente_controller(){
            $Nombre = mainModel::clear_string($_POST['nombre_cliente']);
            $Apellido = mainModel::clear_string($_POST['apellido_cliente']);
            $Edad = mainModel::clear_string($_POST['edad_cliente']);
            $Sexo = mainModel::clear_string($_POST['optionSexo']);
            $Direccion = mainModel::clear_string($_POST['direccion_cliente']);
            $Cel = mainModel::clear_string($_POST['cel_cliente']);
            $Tel = mainModel::clear_string($_POST['tel_cliente']);
            $Dni = mainModel::clear_string($_POST['dni_cliente']);
            $Email = mainModel::clear_string($_POST['email_cliente']);
            $Clave1 = mainModel::clear_string($_POST['clave_cliente1']);
            $Clave2 = mainModel::clear_string($_POST['clave_cliente2']);

            if($Clave1 != $Clave2){
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "Las Contraseñas que acabas de ingresar no coinciden, por favor intente nuevamente",
                    "tipo" => "error",
                    "clase" => "danger"
                ];
            }else{
                if($Email != ""){
                    $consulta1 = mainModel::consulta_simple("select usuario from persona where usuario = '$Email';");

                    if($consulta1->rowCount() >= 1){
                        $alerta = [
                            "Alerta" => "simple",
                            "titulo" => "Ocurrio un error inesperado",
                            "texto" => "El correo que ingreso ya esta registrado",
                            "tipo" => "error",
                            "clase" => "danger"
                        ];
                    }else{
                        $clave = mainModel::encryption($Clave1);
                        $DatosC = [
                            "Nombre_cliente" => $Nombre,
                            "Apellido_cliente" => $Apellido,
                            "Edad_cliente" => $Edad,
                            "Sexo_cliente" => $Sexo,
                            "Direccion_cliente" => $Direccion,
                            "Cel_cliente" => $Cel,
                            "Tel_cliente" => $Tel,
                            "Dni_cliente" => $Dni,
                            "Usuario_cliente" => $Email,
                            "Clave_cliente" => $clave
                        ];
                        $guardar_cliente = clienteModel::add_cliente_model($DatosC);
                        if($guardar_cliente->rowCount() >= 1){
                            $alerta = [
                                "Alerta" => "simple",
                                "titulo" => "Cliente registrado",
                                "texto" => "El cliente se registro con exito en el sistema",
                                "tipo" => "error",
                                "clase" => "success"
                            ];
                        }else{
                            $alerta = [
                                "Alerta" => "simple",
                                "titulo" => "Cliente no registrado",
                                "texto" => "Error indesperado al registrar el cliente",
                                "tipo" => "error",
                                "clase" => "danger"
                            ];
                        }
                    }
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Ocurrio un error inesperado",
                        "texto" => "Hay campos sin rellenar",
                        "tipo" => "error",
                        "clase" => "warning"
                    ]; 
                }
                

            }

            return mainModel::alerts($alerta);
        }
    }
?>