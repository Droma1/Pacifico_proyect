<?php 
	class viewModel{
		protected function view_Model($vistas){
			$listaBlanca=["home","search","login","index","promotion","producto","RegistroCliente"];
			$listaCliente=["ClienteInicio","promotion","producto","search","home"];
			$listaAdministrador=["admin","productadmi","almacen","productventa","repartidores","administrativo","clientes"];
			$listaAlmacen=[];
			
			if(in_array($vistas, $listaBlanca)){
				if(is_file("./View/contents/".$vistas."-view.php")){
					$contenido="./View/contents/".$vistas."-view.php";
				}else{
					$contenido="home";
				}
			}elseif(in_array($vistas, $listaAdministrador)){	
				if(is_file("./View/contents/".$vistas."-view.php")){
					$contenido="./View/contents/".$vistas."-view.php";
				}else{
					$contenido="admin";
				}
			}elseif(in_array($vistas,$listaCliente)){
				if(is_file("./View/contents/".$vistas."-view.php")){
					$contenido="./View/contents/".$vistas."-view.php";
				}else{
					$contenido = "home";
				}
			}elseif($vistas == "Out"){				
				$contenido = null;
			}else{
				$contenido="404";
			}
			return $contenido;
		}
	}
?>