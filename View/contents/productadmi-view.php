<?php require_once "./Controller/listarProductoController.php";
	$categorias = new productoController_l();

	$productos = $categorias->lista_almacen();

?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-md-4">
	<br>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="col-12">
				<h5>Productos en Almacén</h5>
				<br>
				<div class="form-group">
					<ul class="nav">
					  <li class="nav-item">
					    <p class="nav-link btn btn-outline-info" data-toggle="modal" data-target="#modal_add">Agregar <i class="icon-cart-plus"></i></p>
					  </li>
					  <div class="modal fade" id="modal_add" tabindex="-1">
								  <div class="modal-dialog modal-xl">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">agregar Producto</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form action="<?php echo SERVERURL; ?>Ajax/productoAjax.php" data-form="" method="POST" class="formAjax" autocomplete="off" enctype="multipart/from-data">
								        	<div class="row">
								        		<div class="col-xl-6 col-md-6 col-sm-12">
									        		<div class="form-group">
									        			<label for="">Codigo Categoria <i class="icon-plus-circle cat_new"> nuevo</i><i class="icon-ok-circled cat_existente">Existente</i></label>
									        			<input type="text" class="form-control rounded-0 cat_new_input" name="new_cod_cat" placeholder="Ingresar nuevo codigo categoria...">
									        			<select class="form-control rounded-0 cat_existente_select" name="cod_categoria">
															<?php

																$categorias_ = $categorias->listar_categoria();
																foreach($categorias_ as $dato_c => $value){
																	echo '<option value="'.$value[1].'">'.$value[1].'  '.$value['0'].'</option>';
																}
															?>
									        			</select>
									        		</div>
									        		<div class="form-group new_name">
									        			<label for="">Nombre de la categoria</label>
									        			<input type="text" class="form-control rounded-0" name="nombre_categoria" id="_1">
									        		</div>
									        		<div class="form-group new_descrip">
									        			<label for="">Descripción de la Categoria</label>
									        			<textarea class="form-control rounded-0" name="descrip_categoria" id="_2"></textarea>
									        		</div>
									        		<div class="form-group">
									        			<label for="">Codido Producto</label>
									        			<input type="text" class="form-control rounded-0" name="cod_producto" id="_3">
									        		</div>
									        		<div class="form-group">
									        			<label for="">fecha de ingreso de producto</label>
									        			<input type="text" class="form-control rounded-0"value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="" name="fechaIP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Cantidad unitaria del producto</label>
									        			<input type="number" class="form-control rounded-0" name="CantidadP" id="_4">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Disponibilidad del Producto</label>
									        			<select class="form-control rounded-0" name="estadoV">
									        				<option value="EN STOCK">EN STOCK</option>
									        				<option value="AGOTADO">AGOTADO</option>
									        			</select>
									        		</div>
									        		<div class="form-group">
									        			<label for="">Nombre del Producto</label>
									        			<input type="text" class="form-control rounded-0" name="NombreP" id="_5">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Descripción del producto</label>
									        			<textarea class="form-control rounded-0" name="DescripP" id="_6"></textarea>
									        		</div>
									        	</div>
									        	<div class="col-xl-6 col-md-6 col-sm-12">
									        		
									        		<div class="form-group">
									        			<label for="">Altura del producto</label>
									        			<input type="text" class="form-control rounded-0" name="AlturaP" id="_7">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Ancho del Producto</label>
									        			<input type="text" class="form-control rounded-0" name="AnchoP" id="_8">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Precio producto venta</label>
									        			<input type="text" class="form-control rounded-0" name="PrecioV" id="_9">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Precio de entrada a Almacén</label>
									        			<input type="text" class="form-control rounded-0" name="PrecioA" id="_10">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Color:</label>
									        			<input type="text" class="form-control rounded-0" name="ColorP" id="_11">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Fotos del producto</label>
									        			<input type="file" class="form-control rounded-0"name="F1" id="_12">
									        			<input type="file" class="form-control rounded-0"name="F2" id="_13">
									        			<input type="file" class="form-control rounded-0"name="F3" id="_14">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Descuento (%)</label>
									        			<input type="text" class="form-control rounded-0" name="DescuentoP" id="_15">
									        		</div>
									        		<div class="form-gruop">
									        			<label for="">Fecha de inicio de descuento</label>
									        			<input type="date" class="form-control rounded-0" name="FechaID" id="_16">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Fecha de finalización de descuento</label>
									        			<input type="date" class="form-control rounded-0" name="FechaIF" id="_17">
									        		</div>
									        	</div>
									        	
								        	</div>
												<p class="btn btn-outline-warning" id="clear" style="margin:0px;">Limpiar</p>
								        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									        	<button type="submit" class="btn btn-primary">Guardar Cambios</button>
									        	<div class="RespuestaAjax"></div>
								        </form>
								      </div>
								    </div>
								  </div>
								</div>
					  <li class="nav-item">
					    <p class="nav-link"></p>
					  </li>
					</ul>
				</div>
			</div>
			<script>
				$('#clear').click(function(){
					$('#_1').val("");
					$('#_2').val("");
					$('#_3').val("");
					$('#_4').val("");
					$('#_5').val("");
					$('#_6').val("");
					$('#_7').val("");
					$('#_8').val("");
					$('#_9').val("");
					$('#_10').val("");
					$('#_11').val("");
					$('#_12').val("");
					$('#_13').val("");
					$('#_14').val("");
					$('#_15').val("");
					$('#_16').val("");
					$('#_17').val("");

				});
			</script>
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
																<input style="display:none;" type="text" name="codigo_e" id="" value="<?php echo $item[0]; ?>">
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