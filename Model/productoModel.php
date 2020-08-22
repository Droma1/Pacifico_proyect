<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }

    class productoModel extends mainModel{
        protected function Reg_producto_Model($dato){
            $sql = mainModel::conectar()->prepare("call registro_producto(:CodigoCategoria,:NombreCategoria,:DescripCategoria,:CodProducto,:FerchaI,:CantidadP,:EstadoP,:EstadoV,:NombreP,:DescripP,:AlturaP,:AnchoP,:PrecioP,:PrecioPA,:ColorP,F1,:F2,:F3,:DescuentoP,:FechaID,:FechaFD,:EstadoCat);");

            $sql->bindParam(":CodigoCategoria",$dato['CodigoCategoria']);
            $sql->bindParam(":NombreCategoria",$dato['NombreCategoria']);
            $sql->bindParam(":DescripCategoria",$dato['DescripCategoria']);
            $sql->bindParam(":CodProducto",$dato['CodProducto']);
            $sql->bindParam(":FechaI",$dato['FechaI']);
            $sql->bindParam(":CantidadP",$dato['CantidadP']);
            $sql->bindParam(":EstadoP",$dato['EstadoP']);
            $sql->bindParam(":EstadoV",$dato['EstadoV']);
            $sql->bindParam(":NombreP",$dato['NombreP']);
            $sql->bindParam(":DescripP",$dato['DescripP']);
            $sql->bindParam(":AlturaP",$dato['AlturaP']);
            $sql->bindParam(":AnchoP",$dato['AnchoP']);
            $sql->bindParam(":PrecioP",$dato['PrecioP']);
            $sql->bindParam(":PrecioA",$dato['PrecioA']);
            $sql->bindParam(":ColorP",$dato['ColorP']);
            $sql->bindParam(":F1",$dato['F1']);
            $sql->bindParam(":F2",$dato['F2']);
            $sql->bindParam(":F3",$dato['F3']);
            $sql->bindParam(":DescuentoP",$dato['DescuentoP']);
            $sql->bindParam(":FechaID",$dato['FechaID']);
            $sql->bindParam(":FechaFD",$dato['FechaFD']);
            $sql->bindParam(":EstadoCat",$dato['EstadoCat']);

            $sql->execute();

            return $sql;
        }
    }
?>