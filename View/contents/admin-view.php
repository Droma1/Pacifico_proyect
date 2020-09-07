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
					<form>
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
							<label for="">Edad: </label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Sexo: </label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Direccion: </label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Nro Celular: </label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Nro Telefono: </label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">DNI</label>
							<input type="text" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Fecha de Registro</label>
							<input type="text" class="form-control" readonly="">
						</div>
						<div class="form-group"><input type="submit" class="btn btn-success rounded-0" value="Guardar Cambios"></div>

						<div class="Respuesta"></div>

					</form>
				</div>
			</div>
		</div>
	</div>
</main>