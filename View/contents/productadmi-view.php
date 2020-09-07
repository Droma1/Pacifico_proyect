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
															/*require_once "./Config/main.php";
															$objet_ = new mainModel();
																$sql = $objet_->consulta_simple("select cod_categoria from cat_producto;");
																while($row = $sql->fetch()){
																	echo '<option value="'.$row['cod_categoria'].'">'.$row['cod_categoria'].'</option>';
																}*/
															?>
															<option value="CCP">CCP</option>
															<option value="ZB">ZB</option>
															<option value="APL">APL</option>
															<option value="LC">LC lacteos</option>
									        			</select>
									        		</div>
									        		<div class="form-group new_name">
									        			<label for="">Nombre de la categoria</label>
									        			<input type="text" class="form-control rounded-0" name="nombre_categoria">
									        		</div>
									        		<div class="form-group new_descrip">
									        			<label for="">Descripción de la Categoria</label>
									        			<textarea class="form-control rounded-0" name="descrip_categoria"></textarea>
									        		</div>
									        		<div class="form-group">
									        			<label for="">Codido Producto</label>
									        			<input type="text" class="form-control rounded-0" name="cod_producto">
									        		</div>
									        		<div class="form-group">
									        			<label for="">fecha de ingreso de producto</label>
									        			<input type="text" class="form-control rounded-0"value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="" name="fechaIP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Cantidad unitaria del producto</label>
									        			<input type="number" class="form-control rounded-0" name="CantidadP">
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
									        			<input type="text" class="form-control rounded-0" name="NombreP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Descripción del producto</label>
									        			<textarea class="form-control rounded-0" name="DescripP"></textarea>
									        		</div>
									        	</div>
									        	<div class="col-xl-6 col-md-6 col-sm-12">
									        		
									        		<div class="form-group">
									        			<label for="">Altura del producto</label>
									        			<input type="text" class="form-control rounded-0" name="AlturaP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Ancho del Producto</label>
									        			<input type="text" class="form-control rounded-0" name="AnchoP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Precio producto venta</label>
									        			<input type="text" class="form-control rounded-0" name="PrecioV">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Precio de entrada a Almacén</label>
									        			<input type="text" class="form-control rounded-0" name="PrecioA">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Color:</label>
									        			<input type="text" class="form-control rounded-0" name="ColorP">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Fotos del producto</label>
									        			<input type="file" class="form-control rounded-0"name="F1">
									        			<input type="file" class="form-control rounded-0"name="F2">
									        			<input type="file" class="form-control rounded-0"name="F3">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Descuento (%)</label>
									        			<input type="number" class="form-control rounded-0" name="DescuentoP">
									        		</div>
									        		<div class="form-gruop">
									        			<label for="">Fecha de inicio de descuento</label>
									        			<input type="date" class="form-control rounded-0" name="FechaID">
									        		</div>
									        		<div class="form-group">
									        			<label for="">Fecha de finalización de descuento</label>
									        			<input type="date" class="form-control rounded-0" name="FechaIF">
									        		</div>
									        	</div>
									        	
								        	</div>
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
			<div class="col-12">
				<div class="container table-responsive">
				  <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
				  <br>
				  <table class="table table-striped">
				    <thead>
				      <tr>
				        <th>Codigo</th>
				        <th>Categoria</th>
				        <th>Nombre</th>
				        <th>Imagen</th>
				        <th>Opciones</th>
				      </tr>
				    </thead>
				    <tbody id="table_producto">
				      <tr>
				        <td>CCP-A1</td>
				        <td>Concerbas y Comida Preparada</td>
				        <td>Atun A1</td>
				        <td>img...</td>
				        <td><ul class="nav">
							  <li class="nav-item">
							    <p class="nav-link badge badge-warning" data-toggle="modal" data-target="#modal_edit"><i class="icon-pencil"></i></p>
							  </li>
							  <li class="nav-item">
							    <p class="nav-link badge badge-info" data-toggle="modal" data-target="#modal_info"><i class="icon-attention-alt"></i></p>
							  </li>
							  <li class="nav-item">
							    <p class="nav-link badge badge-danger"><i class="icon-trash"></i></p>
							  </li>
							  <div class="modal fade" id="modal_edit" tabindex="-1">
								  <div class="modal-dialog modal-xl">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        edit...
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								        <button type="button" class="btn btn-primary">Guardar Cambios</button>
								      </div>
								    </div>
								  </div>
								</div>
								<div class="modal fade" id="modal_info" tabindex="-1">
								  <div class="modal-dialog modal-xl">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Info Producto</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        info...
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