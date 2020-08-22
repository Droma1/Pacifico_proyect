<?php
    if($peticionAjax){
        require_once "../Model/productoModel.php";
    }else{
        require_once "./Model/productoModel.php";
    }

    class productoController extends productoModel{
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
                $arch = $_FILES['F1']['tmp_name'];
            $ruta1 = "View/imgP/".$F1_name;
            #move_uploaded_file($arch,$ruta1);
            }
            $F2_name = $_FILES['F2']['name'];
            if($F2_name!=""){
                $arch2 = $_FILES['F2']['tmp_name'];
            $ruta2 = "View/imgP/".$F2_name;
            #move_uploaded_file($arch2,$ruta1);
            }
            $F3_name = $_FILES['F3']['name'];
            if($F3_name !=""){
                $arch3 = $_FILES['F3']['tmp_name'];
            $ruta3 = "View/imgP/".$F3_name;
            #move_uploaded_file($arch3,$ruta3);
            }

            if($new_cat=="" && $Cod_cat !=""){
                $categoria_ = $Cod_cat;
                $estado_c = 0;
            }else{
                $categoria_ = $new_cat;
                $estado_c = 1;
            }
            
           if($Nomb_cat !="" && $Cod_p!="" && $CantidadP!="" && $DescripP!="" && $PrecioV!="" && $PrecioA!=""){
               $producto = [
                   "CodigoCategoria" => $categoria_,
                   "NombreCategoria" => $Nomb_cat,
                   "DescripCategoria" => $Des_cat,
                   "CodProducto" => $Cod_p,
                   "FechaI" => $FechaIP,
                   "CantidadP" => $CantidadP,
                   "EstadoP" => $EstadoV,
                   "EstadoV" => "NO VIGENTE",
                   "NombreP" => $NombP,
                   "DescripP" => $DescripP,
                   "AlturaP" => $AlturaP,
                   "AnchoP" => $AnchoP,
                   "PrecioP" => $PrecioV,
                   "PrecioA" => $PrecioA,
                   "ColorP" => $ColorP,
                   "F1" => $arch,
                   "F2" => $arch2,
                   "F3" => $arch3,
                   "DescuentoP" =>$DescuentoP,
                   "FechaID" => $FechaID,
                   "FechaFD" => $FechaFD,
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