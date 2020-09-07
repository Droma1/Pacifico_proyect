<?php//v1.11221?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<?php include "./View/modules/scripts.php"; ?>
</head>
<body>
	<?php  
	$peticionAjax=false;
	
		require_once "./Controller/viewController.php";

		$vt = new viewController();
		$vistasR=$vt->view_Controller();
		//echo $vistasR;
		session_start(['name'=>'VP']);
		if(!isset($_SESSION['tipo_user']) && $vistasR != null):
			//echo $_SESSION['tipo_user'];
				$listaBlanca=["home","search","login","index","promotion","producto","RegistroCliente"];
				include "./View/modules/inicio.php";
				if(isset($_GET['page'])){
					if(in_array($_GET['page'],$listaBlanca)){
						switch($vistasR){
							case 'home':
									
									include "View/contents/baner.php";
									include "View/contents/promotion.php";
									?>
									<section class="container-fluid" id="lista-productos">
									<?php
									include "./View/contents/list-product.php";
									?>
									</section>
									<?php
								break;
			
							case './View/contents/promotion-view.php':
									?>
									<section class="container-fluid" id="lista-productos">
									<?php
									include $vistasR;
									?>
									</section>
									<?php
								break;
			
							case "404":
									include "./View/contents/404-view.php";
							break;
							default:
									include $vistasR;
							break;
			
						}
					}else{
						include "./View/contents/404-view.php";
					}

				}else{
					//echo $vistasR;
					if($vistasR == "home"){
						include "View/contents/baner.php";
						include "View/contents/promotion.php";
						?>
						<section class="container-fluid" id="lista-productos">
						<?php
						include "./View/contents/list-product.php";
						?>
						</section>
						<?php
					}else{
						include "./View/contents/404-view.php";
					}
				}

					
		else:
			#session_destroy();
			

			if(isset($_SESSION['tipo_user'])){
				//echo $_SESSION['tipo_user'];
				
			}else{
				echo "no user";
			}
			//echo "<br>";
			//echo $vistasR;
			#var_dump($_SESSION['tipo_user']);
	?>
	<!-- SideBar -->
	

	<!-- Content page-->
	

		<!-- NavBar -->
		
		
		<!-- Content page -->
		<?php

				if(isset($_SESSION['tipo_user'])){
					if(substr($_SESSION['tipo_user'],0,2) == "AD"){
						include "./View/modules/navbar.php";
						?>
						<section class="container-fluid">
							<div class="row"> 
						<?php
						include "./View/modules/admin.php";
						$listaAdministrador=["admin","productadmi","almacen","productventa","repartidores","administrativo","clientes"];
						if(isset($_GET['page'])){
							if(in_array($_GET['page'], $listaAdministrador)){
								require_once $vistasR;
							}else{
								if($vistasR == null){
									$_SESSION['tipo_user'] = null;
									$_GET['page'] = "login";
									echo '<script> window.location="http://localhost/Pacifico/login" </script>';
								}else{
									require_once "./View/contents/admin-view.php";
								}
							}
						}else{
							require_once "./View/contents/admin-view.php";
						}
						?>
							</div>
						</section>
						<?php
					}elseif(substr($_SESSION['tipo_user'],0,2) == "CL"){
						include "./View/modules/cliente.php";
						$listaCliente=["ClienteInicio","promotion","producto","search","home","compra"];
						if(isset($_GET['page'])){
							if(in_array($_GET['page'], $listaCliente)){
								//echo $vistasR;
								switch($vistasR){
									case 'home':
											
											include "View/contents/baner.php";
											include "View/contents/promotion.php";
											?>
											<section class="container-fluid" id="lista-productos">
											<?php
											include "./View/contents/list-product.php";
											?>
											</section>
											<?php
										break;
					
									case './View/contents/promotion-view.php':
											?>
											<section class="container-fluid" id="lista-productos">
											<?php
											include $vistasR;
											?>
											</section>
											<?php
										break;
					
									case "404":
											include "./View/contents/404-view.php";
									break;
									default:
											include $vistasR;
									break;
								}
								//echo $vistasR;
							}else{
								if($vistasR == null){
									$_SESSION['tipo_user'] = null;
									$_GET['page'] = "login";
									echo '<script> window.location="http://localhost/Pacifico/login" </script>';
								}else{
									require_once "./View/contents/ClienteInicio-view.php";
								}
							}
						}else{
							require_once "./View/contents/ClienteInicio-view.php";
						}
					}/*elseif(substr($_SESSION['tipo_user'],0,2) == "AM"){
	
					}elseif(substr($_SESSION['tipo_user'],0,2) == "RP"){
						
					}elseif(substr($_SESSION['tipo_user'],0,2) == "AL"){
	
					}*/
					
				}
		 ?>
		
	<?php endif; ?>

	<!--===== Scripts -->
	
</body>

</html>
<script src="<?php echo SERVERURL; ?>View/js/carrito.js"></script>
<script src="<?php echo SERVERURL; ?>View/js/pedido.js"></script>