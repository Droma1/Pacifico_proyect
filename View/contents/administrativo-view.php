<main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-md-4">
	<br>
	<div class="card rounded-0">
		<div class="card-body">
			<div class="col-12">
				<h5>Administrativo</h5>
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
								        <h5 class="modal-title" id="exampleModalLabel">Agregar Administrativo</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <form class="FormularioAjax" data-form="save">
								        	<div class="row">
								        		<div class="col-xl-6 col-md-6 col-sm-12">
												    <div class="form-group">
									        			<label for="">Codigo</label>
														<input type="text" class="form-control rounded-0"value="<?php echo 'CA001'; ?>" readonly="">
									        		</div>
									        		<div class="form-group">
													<label for="">Nombres</label>
														<input type="text" class="form-control rounded-0">																																												
									        		</div>
									        
									        		<div class="form-group">
									        			<label for="">Apellidos</label>
									        			<input type="text" class="form-control rounded-0">
									        		<div class="form-group">
									        			<label for="">Edad</label>
									        			<input type="number" class="form-control rounded-0">
									        		</div>
									        		
									        		<div class="form-group">
									        			<label for="">Direccion</label>
									        			<input type="text" class="form-control rounded-0">
									        		</div>
									        		
												</div>
																		        	
											</div>
											<div class="col-xl-6 col-md-12 col-sm-12">
												    <div class="form-group">
									        		<label for="">Fotos</label>
									        			<input type="file" class="form-control rounded-0">
									        		</div>
									        		
											</div>

								        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
									        	<button type="button" class="btn btn-primary">Guardar Cambios</button>
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
				        <th>Nombre</th>
				        <th>Apellidos</th>
				        <th>Estado</th>
				        <th>Opciones</th>
				      </tr>
				    </thead>
				    <tbody id="table_producto">
				      <tr>
				        <td>CAD001</td>
				        <td>Fernando</td>
				        <td>Flores Condori</td>
				        <td>Habilitado</td>
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
								        <h5 class="modal-title" id="exampleModalLabel">Editar Administrativo</h5>
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
								        <h5 class="modal-title" id="exampleModalLabel">Info Administrativo</h5>
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