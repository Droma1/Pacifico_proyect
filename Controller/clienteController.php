<?php
    if($peticionAjax){
        require_once "../Model/clienteModel.php";
    }else{
        require_once "./Model/clienteModel.php";
    }

    class clienteController extends clienteModel{

        public function comprar(){
            $cod_cliente = $_POST['cod_cliente'];
            $saldo_c = $_POST['saldo_c'];
            $monto_c = $_POST['monto_c'];
            $fecha_c = $_POST['fecha_c'];
            $cant = $_POST['cant'];
            $precio_u = $_POST['precio_i'];
            $cod_prod = $_POST['cod_producto'];

            

            if($saldo_c>0 && $monto_c < $saldo_c){
                $new_saldo = $saldo_c - $monto_c;
                $datos_compra = [
                    "codigo_cliente" => $cod_cliente,
                    "saldo_cliente" => $new_saldo,
                    "monto_compra" => $monto_c,
                    "cod_producto" => $cod_prod,
                    "cantidad" => $cant,
                    "metodo" => "EN EFECTIVO",
                    "precio_u" => $precio_u,
                    "fecha" => date('Y-m-d H:i:s')
                ];
                $sql = clienteModel::comprar_model($datos_compra);
                if($sql->rowCount()>0){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Compra Exitosa!",
                        "texto" => "Se realió la compra de manera exitosa...",
                        "tipo" => "Realizado!",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Error de Sistema!",
                        "texto" => "No se pudo completar la compra le pedimos que vuelva a intentar...",
                        "tipo" => "compra fallida!",
                        "clase" => "danger"
                    ];
                }
                
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Problemas!",
                    "texto" => "Usted no cuenta con saldo suficiente para realizar compras le recomendamos realizar una recarga...",
                    "tipo" => "compra fallida!",
                    "clase" => "warning"
                ];
            }

            return mainModel::alerts($alerta);
        }

        public function recarga_cliente(){
            $codigo = mainModel::clear_string($_POST['cod_cliente']);
            $monto = mainModel::clear_string($_POST['monto']);
            $boucher = $_FILES['boucher']["name"];
            $fecha = mainModel::clear_string($_POST['date']);

            if($monto !="" && $boucher !="" && $fecha !=""){
                if($boucher !=""){
                    $type=$_FILES['boucher']['type'];
                    $tmp_name = $_FILES['boucher']["tmp_name"];
                    $name = $_FILES['boucher']["name"];
                    $nuevo_path="../View/imgP/".$name;
                    move_uploaded_file($tmp_name,$nuevo_path);
                    $array=explode('.',$nuevo_path);
                    $ruta = $nuevo_path;
                    $arch=$name;
                    $ext= end($array);
                }
                $datos_recarga = [
                    "codigo" => $codigo,
                    "monto" => $monto,
                    "boucher" => $arch,
                    "estado" => "PROCESO",
                    "fecha" => $fecha
                ];
                //echo $arch;
                $respuesta = clienteModel::recarga_cliente_model($datos_recarga);
                if($respuesta->rowCount()>=1){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Recarga exitosa!",
                        "texto" => "Su recarga fue procesado con exito espera la respuesta de los administradores para la verificacion de su boucher...",
                        "tipo" => "Completado!",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Error de Sistema!",
                        "texto" => "Se produgeron errores con el sistema y no se pudo registrar su recarga, vuelva a intentar...",
                        "tipo" => "Error!",
                        "clase" => "danger"
                    ];
                }
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Advertencia!",
                    "texto" => "Faltan campos por completar, asegurese que lleno todos los campos que se necesitan...",
                    "tipo" => "Error!",
                    "clase" => "warning"
                ];
            }
            return mainModel::alerts($alerta);
        }

        public function edit_cliente(){
            
            $nombre = mainModel::clear_string($_POST['name_edit']);
            $apellido = mainModel::clear_string($_POST['app_edit']);
            $edad = mainModel::clear_string($_POST['edad_edit']);
            $sexo_o = mainModel::clear_string($_POST['sexo_origin']);
            $sexo = mainModel::clear_string($_POST['sexo_edit']);
            $Direccion = mainModel::clear_string($_POST['direc_edit']);
            $nro_cel = mainModel::clear_string($_POST['cel_edit']);
            $nro_tel = mainModel::clear_string($_POST['tel_edit']);
            $dni = mainModel::clear_string($_POST['dni_edit']);
            $usuario = mainModel::clear_string($_POST['user_edit']);
            $pass = mainModel::clear_string($_POST['pass_edit']);

            if($codigo_ =!"" && $nombre!="" && $apellido !="" && $nro_cel !="" && $dni !="" && $usuario !="" && $pass!=""){

                $clave_v = mainModel::consulta_simple("select clave from persona where usuario = '$usuario';");
                if($clave_v->rowCount() >=1){
                    $verif = (array) $clave_v->fetch();
                    $clave_x = mainModel::verify($pass,$verif[0]);
                    if($clave_x == true){
                        if($sexo != $sexo_o && $sexo != 0){
                            $sexo_o = $sexo;
                        }
                        $datos_edit = [
                            "codigo" => $_POST['cod_edit'],
                            "nombre" => $nombre,
                            "apellido" => $apellido,
                            "edad" => $edad,
                            "sexo" => $sexo_o,
                            "direccion" => $Direccion,
                            "cel" => $nro_cel,
                            "tel" => $nro_tel,
                            "dni" => $dni
                        ];
                        $editar_cliente = clienteModel::edit_cliente_model($datos_edit);
                        if($editar_cliente->rowCount() >= 1){
                            $alerta = [
                                "Alerta" => "simple",
                                "titulo" => "Proceso Completado!",
                                "texto" => "Las Modificaciones se guardaron exitosamente....",
                                "tipo" => "Completado!",
                                "clase" => "success"
                            ];
                        }else{
                            $alerta = [
                                "Alerta" => "simple",
                                "titulo" => "Error de sistema!",
                                "texto" => "se produjo un error inesperado al guardar los datos o no se registraron cambios...",
                                "tipo" => "Advertencia",
                                "clase" => "danger"
                            ];
                        }

                    }else{
                        $alerta = [
                            "Alerta" => "simple",
                            "titulo" => "Error de usuario!",
                            "texto" => "Las contraseñas no coinciden vuelva a intentar...",
                            "tipo" => "Advertencia",
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
            return mainModel::alerts($alerta);
        }
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