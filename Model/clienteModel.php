<?php
    if($peticionAjax){
        require_once "../Config/main.php";
    }else{
        require_once "./Config/main.php";
    }
    class clienteModel extends mainModel{
        protected function recarga_cliente_model($datos){
            $cod = $datos["codigo"];
            $sql = mainModel::consulta_simple("select id_cliente from cliente where cod_cliente = '".$cod."';");
            $sql_ = (array) $sql->fetch();
            $id_c = $sql_[0];
            $sql2 = mainModel::conectar()->prepare("insert into recarga(monto_recarga,boucher,estado_recarga,fecha_recarga,id_cliente) values(:monto,:boucher_,:estado,:fecha,:id);");
            $sql2->bindParam(":monto",$datos['monto']);
            $sql2->bindParam(":boucher_",$datos['boucher']);
            $sql2->bindParam(":estado",$datos['estado']);
            $sql2->bindParam(":fecha",$datos['fecha']);
            $sql2->bindParam(":id",$id_c);
            $sql2->execute();
            return $sql2;
        }
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
        protected function edit_cliente_model($datos){
            //echo var_dump($datos);
            $cod = $datos['codigo'];
            //echo $cod;
            $sql = mainModel::consulta_simple("select * from persona inner join cliente on cliente.id_persona = persona.id_persona and cod_cliente = '".$cod."';");

            //echo var_dump($sql->fetch());
            $id_p = (array) $sql->fetch();
            $id = $id_p[0];
            $sql = mainModel::conectar()->prepare("update persona set nombres_p = :nombre,apellidos_p = :apellido,edad=:edad,sexo=:sexo,direccion_p=:direc,nro_cel=:cel,nro_tel=:tel,dni=:dni where id_persona = ".$id.";");
            $sql->bindParam(":nombre",$datos['nombre']);
            $sql->bindParam(":apellido",$datos['apellido']);
            $sql->bindParam(":edad",$datos['edad']);
            $sql->bindParam(":sexo",$datos['sexo']);
            $sql->bindParam(":direc",$datos['direccion']);
            $sql->bindParam(":cel",$datos['cel']);
            $sql->bindParam(":tel",$datos['tel']);
            $sql->bindParam(":dni",$datos['dni']);

            $sql->execute();
            return $sql;
        }
    }
?>