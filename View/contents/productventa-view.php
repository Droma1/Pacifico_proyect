<?php require_once "./Controller/listarProductoController.php";
	$categorias = new productoController_l();

	$productos = $categorias->lista_venta();

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-md-4">
	<br>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="col-12">
			<div class="container table-responsive">
				  <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
				  <br>
				  <div class="row" style="overflow:auto;">
					<table class="table table-striped">
						<thead>
						<tr>
							<th>#</th>
							<th>Codigo</th>
							<th>Categoria</th>
							<th>Nombre</th>
							<th>Imagen</th>
							<th>Opciones</th>
						</tr>
						</thead>
						<tbody id="table_producto">
						
						<?php $cont  = 0; while($item = $productos->fetch()){ $cont++; ?>
						<tr>
							<td><?php echo $cont; ?></td>
							<td><?php echo $item[0]; ?></td>
							<td><?php echo $item[1]; ?></td>
							<td><?php echo $item[2]; ?></td>
							<td><img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $item[3]; ?>" alt="" height=100></td>
							<td><ul class="nav">
								<li class="nav-item">
									<p class="nav-link badge badge-warning" data-toggle="modal" data-target="#modal_edit<?php echo $item[0]; ?>"><i class="icon-pencil"></i></p>
								</li>
								<li class="nav-item">
									<p class="nav-link badge badge-info" data-toggle="modal" data-target="#modal_info<?php echo $item[0]; ?>"><i class="icon-attention-alt"></i></p>
								</li>
								<div class="modal fade" id="modal_edit<?php echo $item[0]; ?>" tabindex="-1">
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
														<div class="form-group">
															<label for="">Codigo del Producto:</label>
															<p class="text-muted"><?php echo $item[0]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Nombre de la Categoria del Producto:</label>
															<p class="text-muted"><?php echo $item[1]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Nombre del Producto:</label>
															<p class="text-muted"><?php echo $item[2]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Cantidad del Producto:</label>
															<p class="text-muted"><?php echo $item[5]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Estado :</label>
															<p class="text-muted"><?php echo $item[4]; ?></p>
															<form action="<?php echo SERVERURL; ?>Ajax/productoAjax.php" method="post" class="formAjax">
																<input style="display:none;" type="text" name="codigo_cambiar" id="" value="<?php echo $item[0]; ?>">
																<input type="submit" value="Cambiar estado" class="btn btn-outline-info rounded-0">
																<br>
																<div class="RespuestaAjax"></div>
															</form>
														</div>
													</div>
													<div class="col-md-6">
														<div class="card">
															<div class="card-body">
																<img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $item[3]; ?>" style="width:100%;" alt="">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										</div>
										</div>
									</div>
									</div>
									<div class="modal fade" id="modal_info<?php echo $item[0]; ?>" tabindex="-1">
									<div class="modal-dialog modal-xl">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Info Producto</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="">Codigo del Producto:</label>
															<p class="text-muted"><?php echo $item[0]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Nombre de la Categoria del Producto:</label>
															<p class="text-muted"><?php echo $item[1]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Nombre del Producto:</label>
															<p class="text-muted"><?php echo $item[2]; ?></p>
														</div>
														<div class="form-group">
															<label for="">Cantidad del Producto:</label>
															<p class="text-muted"><?php echo $item[4]; ?></p>
														</div>
													</div>
													<div class="col-md-6">
														<div class="card">
															<div class="card-body">
																<img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $item[3]; ?>" style="width:100%;" alt="">
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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