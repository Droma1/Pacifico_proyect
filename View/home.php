<!DOCTYPE html>
<html lang="es">
<head>
	<title><?php echo COMPANY; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>
	<?php  
	$peticionAjax=false;
	
		require_once "./Controller/viewController.php";

		$vt = new viewController();
		$vistasR=$vt->view_Controller();
		#echo $vistasR;

		if($vistasR=="home" || $vistasR == "404" || $vistasR == "login" || $vistasR == "promotion" || $vistasR == "producto" || $vistasR == "RegistroCliente"):

			switch($vistasR){
				case 'home':
						include "./View/modules/inicio.php";
						include "View/contents/baner.php";
						include "View/contents/promotion.php";
						include "View/contents/list-product.php";
					break;
				case 'login':
						include "./View/modules/inicio.php";
						include "View/contents/login-view.php";
						
					break;
				case 'promotion':
						include "./View/modules/inicio.php";
						include "./View/contents/promotion-view.php";
					break;
				case 'producto':
						include "./View/modules/inicio.php";
						include "./View/contents/producto-view.php";
					break;
				case "RegistroCliente":
						include "./View/modules/inicio.php";
						include "./View/contents/RegistroCliente-view.php";
					break;
				default:
				include "./View/contents/404-view.php";
				break;

			}
			
					

					
		else:
			#session_destroy();
			session_start(['name'=>'VP']);

			if(isset($_SESSION['tipo_user'])){
				echo $_SESSION['tipo_user'];
			}
			#var_dump($_SESSION['tipo_user']);
	?>
	<!-- SideBar -->
	<?php include "./View/modules/navbar.php";
	?>

	<!-- Content page-->
	<section class="container-fluid">
		<div class="row">

		<!-- NavBar -->
		<?php include "./View/modules/admin.php"; ?>
		
		<!-- Content page -->
		<?php require_once $vistasR;?>
		</div>
	</section>
	<?php endif; ?>

	<!--===== Scripts -->
	<?php include "./View/modules/scripts.php"; ?>
</body>
</html>