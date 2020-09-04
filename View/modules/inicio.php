<section class="content head_home">
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 col-sp-12 col-logo">
				<div class="h-logo"><a href="<?php echo SERVERURL; ?>"><img src="<?php echo SERVERURL; ?>View/img/logo.jpg" alt="" class="img-fluid"></a></div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-3 col-sm-3 col-xs-3 col-sp-3 col-menu">
				<div class="navbar navbar-expand-sm navbar-light  justify-content-center br_home">
						<div class="navbar-nav">
							<li class="nav-item"><a href="<?php echo SERVERURL; ?>" class="nav-link"><strong>Inico</strong></a></li>
							<li class="nav-item"><a href="#" class="nav-link"><strong>Galeria</strong></a></li>
							<li class="nav-item"><a href="promotion" class="nav-link"><strong>Promociones</strong></a></li>
						</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-9 col-sm-9 col-xs-9 col-sp-9 col-info">
				<div class="navbar navbar-expand-sm navbar-light  justify-content-center br_home">
						<div class="navbar-nav">
							<li class="nav-item"><a href="login" class="nav-link"><i class="icon-user"></i></a></li>
							<li class="nav-item"><a  class="nav-link" id="car-show">
								<strong>
									<i class="icon-basket"></i>
									<span class="badge badge-warning">0</span>
								</strong></a>
							</li>
							<li class="nav-item"><a class="nav-link">$/. 0.00</a></li>
						</div>
				</div>
			</div>
		</div>
	</div>

</section>
<?php require_once "./Controller/listarProductoController.php";
	$categorias = new productoController_l();
?>
<div class="content bar_inf">
		<div class="container">
			<div class="row bar_nav">
				<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 col-sp-12 col-categories">
					<div class="categories">
						<h4>Categorias  <span class="icon-down-open menos"></span></h4>
					</div>
					<div class="items-category">
						<ul class="list-group" style="text-align: left;">
							<?php
								$categorias_ = $categorias->listar_categoria();
								foreach($categorias_ as $dato_c => $value){
									#$dato_ = array();
									#$dato_ = $dato_c;
									echo "<li class='list-group-item'><a href='#'>$value[0]</a></li>";
								}
							?>
						</ul>
					</div>
				</div>
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 col-sp-12 col-search">
					<div class="search">
						<form action="search" method="post">
							<div class="input-group md-form form-sm form-2 pl-0">
					            <input type="text" class="form-control input-search" name="search"  placeholder="Buscar">
					            <div class="input-group-append">
					                <button class="input-group-text btn-search"><i class="icon-search"></i></button>
					            </div>
					        </div>
						</form>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-xs-12 col-sp-12 col-number">
					<div class="number" style="padding: 10px 0px;">
						<h6> <i class="icon-call" style="border-radius: 100%; border: 1px solid #a9a7a7;"></i>    +51 987 654 321</h6>
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="row content-car" style="justify-content:center;">
	<section class="container car-box">
		<div class="shadow-lg card">
			<div class="card-body">
				<div class="alert alert-light alert-dismissible fade show" id="carrito" role="alert">
					<ul class="list-group list-group-flush" id="lista-carrito">
						<li class="list-group-item" id="body-carrito">
							<div class="col-12">
								<div class="row">
									<div class="col-md-4">
										<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="max-height:80px;">
									</div>
									<div class="col-md-8">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<h5>Yogurt Gloria 1L</h5>
													<label for="">Precio: S/. 5.00</label>
													<br>
													<label for="">Descuento: 7%</label>
												</div>
											</div>
											<div class="col-md-6">
											
												<div class="form-group">
													<label for="">Cantidad: </label>
													<label>
														<select name="" id="" class="form-control-sm">
															<option value="1">1</option>
															<option value="2">2</option>
															<option value="3">3</option>
														</select>
													</label>
													<input type="submit" value="X" class="btn btn-outline-danger btn-sm float-right">
												</div>
													
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</li>
						<li class="list-group-item text-center"><label for=""><strong>No hay productos </strong> seleccione productos para añadir a su carrito</label></li>
						<li class="list-group-item"><label for="" class="float-right">Total:<strong>S/. 4.90</strong></label></li>
					</ul>

					<button type="button" class="close close-car">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		</div>
	</section>
</div>
<style>
	.car-box{
		position:absolute;
		z-index:100;
		margin:auto;
		transform:translateY(10%);
	}
</style>
