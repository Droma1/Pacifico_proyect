<?php
    require_once "./Controller/admin-viewController.php";
    $perfil = new AdminViewController();
    $datos = $perfil->perfil($_SESSION['tipo_user']);

	$dato = (array) $datos->fetch();
	//echo $_SESSION['tipo_user'];
	//echo var_dump($dato);
    
?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-md-4">
	<br>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="img_user">
					</div>
					<br>
				</div>
				<div class="col-md-6 col-sm-12">
					
						<div class="form-group">
							<label for="">Nombres: <?php echo $dato['0']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Apellidos: <?php echo $dato['1']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Usuario: <?php echo $dato['9']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Titulo Profesional: <?php echo $dato['11']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Edad: <?php echo $dato['2']; ?></label>
						</div>
						
				</div>
				<div class="col-md-6 col-sm-12">
				<div class="form-group">
							<label for="">Sexo: <?php echo $dato['3']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Direccion: <?php echo $dato['4']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Nro Celular: <?php echo $dato['5']; ?></label>
						</div>
						
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="form-group">
							<label for="">Nro Telefono: <?php echo $dato['6']; ?></label>
						</div>
						<div class="form-group">
							<label for="">DNI: <?php echo $dato['7']; ?></label>
						</div>
						<div class="form-group">
							<label for="">Fecha de Registro: <?php echo $dato['8']; ?></label>
						</div>
				</div>
			</div>
		</div>
	</div>
</main>