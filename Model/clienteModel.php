<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
    class clienteModel extends mainModel{
        protected function add_cliente_model($datos){
			$sql = mainModel::conectar()->prepare("call registro_clientes(:Nombre,:Apellido,:Edad,:Sexo,:Direccion,:Cel,:Tel,:Dni,:Fecha,:Usuario,:Clave,:Estado);");

			$sql->bindParam(":Nombre",$datos['Nombre_cliente']);
            $sql->bindParam(":Apellido",$datos['Apellido_cliente']);
			$sql->bindParam(":Edad",$datos['Edad_cliente']);
			$sql->bindParam(":Sexo",$datos['Sexo_cliente']);
            $sql->bindParam(":Direccion",$datos['Direccion_cliente']);
            $sql->bindParam(":Cel",$datos['Cel_cliente']);
            $sql->bindParam(":Tel",$datos['Tel_cliente']);
            $sql->bindParam(":Dni",$datos['Dni_cliente']);
            $fecha = date('Y-m-d H:i:s');
			$sql->bindParam(":Fecha",$fecha);
			$sql->bindParam(":Usuario",$datos['Usuario_cliente']);
            $sql->bindParam(":Clave",$datos['Clave_cliente']);
            $estado = "HABILITADO";
			$sql->bindParam(":Estado",$estado);

			$sql->execute();
			return $sql;
		}
    }
?>