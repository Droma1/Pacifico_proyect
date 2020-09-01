<?php 
	class viewModel{
		protected function view_Model($vistas){
			$listaBlanca=["home","clientes","admin","search","productadmi","productventa","almacen","repartidores","administrativo"];
			$listaCliente=[];
			$listaAdministrador=[];
			$listaAlmacen=[];
			
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./View/contents/".$vistas."-view.php")){
					$contenido="./View/contents/".$vistas."-view.php";
				}else{
					$contenido="home";
				}
			}elseif($vistas == "search"){
				$contenido = "search";
			}elseif($vistas=="login"){
				$contenido="login";
			}elseif($vistas=="index"){
				$contenido="home";
			}elseif($vistas == "promotion"){
				$contenido = "promotion";	
			}elseif($vistas == "producto"){
				$contenido = "producto";
			}elseif($vistas == "RegistroCliente"){
				$contenido = "RegistroCliente";
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}
?>