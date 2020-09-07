<?php
    if($peticionAjax){
        require_once "../Model/productoModel.php";
    }else{
        require_once "./Model/productoModel.php";
    }

    class productoController extends productoModel{

        public function estado_prod_v(){
            $codigo_p = $_POST['codigo_cambiar'];

            $respuesta = mainModel::consulta_simple("update producto set estado_venta = 'NO VIGENTE' where cod_producto = '".$codigo_p."';");

            if($respuesta->rowCount()>0){
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Exito!",
                    "texto" => "Se guardaron los cambios exitosamente se le recomienda actualizar la pagina",
                    "tipo" => "success!",
                    "clase" => "success"
                ];
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Problemas del sistema!",
                    "texto" => "No se pudo cambiar estado",
                    "tipo" => "Error!",
                    "clase" => "danger"
                ];
            }

            return mainModel::alerts($alerta);
        }

        public function estado_prod(){
            $codigo_p = $_POST['codigo_e'];

            $respuesta = mainModel::consulta_simple("update producto set estado_venta = 'VIGENTE' where cod_producto = '".$codigo_p."';");

            if($respuesta->rowCount()>0){
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Exito!",
                    "texto" => "Se guardaron los cambios exitosamente se le recomienda actualizar la pagina",
                    "tipo" => "success!",
                    "clase" => "success"
                ];
            }else{
                $alerta = [
                    "Alerta" => "simple",
                    "titulo" => "Problemas del sistema!",
                    "texto" => "No se pudo cambiar estado",
                    "tipo" => "Error!",
                    "clase" => "danger"
                ];
            }

            return mainModel::alerts($alerta);
        }
        public function Reg_producto_Controller(){
            $Cod_cat = mainModel::clear_string($_POST['cod_categoria']);
            $new_cat = mainModel::clear_string($_POST['new_cod_cat']);
            $Nomb_cat = mainModel::clear_string($_POST['nombre_categoria']);
            $Des_cat = mainModel::clear_string($_POST['descrip_categoria']);
            $Cod_p = mainModel::clear_string($_POST['cod_producto']);
            $FechaIP = mainModel::clear_string($_POST['fechaIP']);
            $CantidadP = mainModel::clear_string($_POST['CantidadP']);
            $EstadoV = mainModel::clear_string($_POST['estadoV']);
            $NombP = mainModel::clear_string($_POST['NombreP']);
            $DescripP = mainModel::clear_string($_POST['DescripP']);
            $AlturaP = mainModel::clear_string($_POST['AlturaP']);
            $AnchoP = mainModel::clear_string($_POST['AnchoP']);
            $PrecioV = mainModel::clear_string($_POST['PrecioV']);
            $PrecioA = mainModel::clear_string($_POST['PrecioA']);
            $ColorP = mainModel::clear_string($_POST['ColorP']);
            $DescuentoP = mainModel::clear_string($_POST['DescuentoP']);
            $FechaID = mainModel::clear_string($_POST['FechaID']);
            $FechaFD = mainModel::clear_string($_POST['FechaIF']);
            #$F1 = $_REQUEST['F1'];
            $F1_name = $_FILES['F1']['name'];
            if($F1_name !=""){
                $type=$_FILES['F1']['type'];
                $tmp_name = $_FILES['F1']["tmp_name"];
                $name = $_FILES['F1']["name"];
                $nuevo_path="../View/imgP/".$name;
                move_uploaded_file($tmp_name,$nuevo_path);
                $array=explode('.',$nuevo_path);
                $ruta1 = $nuevo_path;
                $arch=$F1_name;
                $ext= end($array);

            }
            $F2_name = $_FILES['F2']['name'];
            if($F2_name!=""){
                $type=$_FILES['F2']['type'];
                $tmp_name = $_FILES['F2']["tmp_name"];
                $name = $_FILES['F2']["name"];
                $nuevo_path="../View/imgP/".$name;
                move_uploaded_file($tmp_name,$nuevo_path);
                $array=explode('.',$nuevo_path);
                $ruta2 = $nuevo_path;
                $arch2=$F2_name;
                $ext= end($array);
            }
            $F3_name = $_FILES['F3']['name'];
            if($F3_name !=""){
                $type=$_FILES['F3']['type'];
                $tmp_name = $_FILES['F3']["tmp_name"];
                $name = $_FILES['F3']["name"];
                $nuevo_path="../View/imgP/".$name;
                move_uploaded_file($tmp_name,$nuevo_path);
                $array=explode('.',$nuevo_path);
                $ruta3 = $nuevo_path;
                $arch3=$F3_name;
                $ext= end($array);
            }

            if($new_cat=="" && $Cod_cat !=""){
                $categoria_ = $Cod_cat;
                $estado_c = 0;
            }else{
                $categoria_ = $new_cat;
                $estado_c = 1;
            }
            
           if($categoria_ !="" && $Cod_p!="" && $CantidadP!="" && $DescripP!="" && $PrecioV!="" && $PrecioA!=""){
               $producto = [
                   "CodigoCategoria" => "$categoria_",
                   "NombreCategoria" => "$Nomb_cat",
                   "DescripCategoria" => "$Des_cat",
                   "CodProducto" => "$Cod_p",
                   "FechaI" => "$FechaIP",
                   "CantidadP" => floatval($CantidadP),
                   "EstadoP" => "$EstadoV",
                   "EstadoV" => "NO VIGENTE",
                   "NombreP" => "$NombP",
                   "DescripP" => "$DescripP",
                   "AlturaP" => floatval($AlturaP),
                   "AnchoP" => floatval($AnchoP),
                   "PrecioP" => floatval($PrecioV),
                   "PrecioA" => floatval($PrecioA),
                   "ColorP" => "$ColorP",
                   "F1" => "$arch",
                   "F2" => "$arch2",
                   "F3" => "$arch3",
                   "DescuentoP" =>floatval($DescuentoP),
                   "FechaID" => "$FechaID",
                   "FechaFD" => "$FechaFD",
                   "EstadoCat" => $estado_c
               ];
               $guardar_producto = productoModel::Reg_producto_Model($producto);
               if($guardar_producto->rowCount() >=1){
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Completado!",
                        "texto" => "Se registro exitosamente el Producto",
                        "tipo" => "Terminado...",
                        "clase" => "success"
                    ];
                }else{
                    $alerta = [
                        "Alerta" => "simple",
                        "titulo" => "Error inesperado",
                        "texto" => "No se completo el guardado del Registro",
                        "tipo" => "Failed...",
                        "clase" => "danger"
                    ];
                }
           }else{
            $alerta = [
                "Alerta" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Faltan completar algunos campos requeridos para el ingreso del producto",
                "tipo" => "error",
                "clase" => "warning"
            ];
           }
            return mainModel::alerts($alerta);
        }
    }
?>