<?php
    require_once "./Controller/admin-viewController.php";
    $perfil = new AdminViewController();
    $datos = $perfil->listar_cliente();

	//$dato = (array) $datos->fetch();
	//echo $_SESSION['tipo_user'];
	//echo var_dump($dato);
    
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-md-4">
	<br>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="col-12">
				<h5>Clientes</h5>
				<br>
				<div class="form-group">
					<ul class="nav">
					  <li class="nav-item">
					    <p class="nav-link"></p>
					  </li>
					</ul>
				</div>
			</div>
			<div class="col-12" style="overflow:auto;">
				<div class="container table-responsive">
				  <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
				  <br>
				  <table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Codigo</th>
				        <th>Nombre</th>
				        <th>Apellidos</th>
				        <th>Estado</th>
						<th>Estado de Recarga</th>
				        <th>Opciones</th>
				      </tr>
				    </thead>
				    <tbody id="table_producto">
					<?php $contador = 0; while($dato = $datos->fetch()){ $contador++;?>
				      <tr>
				        <td><?php echo $dato[0]; ?></td>
				        <td><?php echo $dato[1]; ?></td>
				        <td><?php echo $dato[2]; ?></td>
				        <td><?php echo $dato[7]; ?></td>
						<td><?php if($dato[10] == "COMPLETADO"){?> <p class="badge badge-success"><?php echo $dato[10]; ?></p> <?php }else{ ?> <p class="badge badge-warning"><?php echo $dato[10]; ?></p> <?php } ?></td>
				        <td><ul class="nav">
							  <li class="nav-item">
							    <p class="nav-link badge badge-warning" data-toggle="modal" data-target="#modal_edit<?php echo $contador; ?>"><i class="icon-pencil"></i></p>
							  </li>
							  <div class="modal fade" id="modal_edit<?php echo $contador; ?>" tabindex="-1">
								  <div class="modal-dialog modal-xl">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <div class="col-md-12">
											<div class="row">
												<div class="col-md-6">
													<div class="from-group">
														<label for="">Codigo del cliente:<?php echo $dato[0]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Nombre del cliente:<?php echo $dato[1]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Apellidos del cliente:<?php echo $dato[2]; ?></label>													
													</div>
													<div class="form-group">
														<label for="">Edad del cliente:<?php echo $dato[3]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Direccion:<?php echo $dato[4]; ?></label>													
													</div>
													<div class="form-group">
														<label for="">Usuario: <?php echo $dato[5]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Saldo Actual:<?php echo $dato[6]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Monto de Recarga:<?php echo $dato[8]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Estado de la Recarga: <?php echo $dato[10]; ?></label>
													</div>
													<div class="form-group">
														<label for="">Fecha de la Recarga: <?php echo $dato[11]; ?></label>
													</div>
													<?php if($dato[10]== "PROCESO"){ ?> 
													<div class="form-group">
														<form action="<?php echo SERVERURL; ?>Ajax/Ajax_recarga.php" method="post" class="formAjax">
															<input type="text" name="id_recarga" value="<?php echo $dato[12]; ?>" id="" style="display:none;">
															<input type="text" value="<?php echo $dato[0]; ?>" name="codigo_cliente_recarga" style="display:none;">
															<input type="text" value="<?php echo $dato[8]; ?>" name="monto" style="display:none;">
															<input type="submit" value="Aceptar Recarga" class="btn btn-outline-success">
															<br>
															<div class="RespuestaAjax"></div>
														</form>
													</div>
													 <?php } ?>
												</div>
												<div class="col-md-6">
													<div class="card">
														<div class="card-body">
															<img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $dato[9]; ?>" style="width:100%;" alt="">
														</div>
													</div>
												</div>
											</div>
										</div>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
								      </div>
								    </div>
								  </div>
								</div>
							</ul>
						</td>
				      </tr>

					<?php } ?>
				    </tbody>
				  </table>
				  
				</div>

				<script>
				$(document).ready(function(){
				  $("#entrada").on("keyup", function() {
				    var value = $(this).val().toLowerCase();
				    $("#table_producto tr").filter(function() {
				      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				    });
				  });
				});
				</script>

			</div>
		</div>
	</div>
</main>