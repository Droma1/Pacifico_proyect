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
							<li class="nav-item"><a href="#" class="nav-link">
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
						<form>
							<div class="input-group md-form form-sm form-2 pl-0">
					            <input class="form-control input-search" type="text" placeholder="Buscar">
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