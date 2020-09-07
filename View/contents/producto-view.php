<?php if(isset($_POST['producto'])){ 
		require_once "./Controller/listarProductoController.php";
		$product = new productoController_l();
		$producto_view = $product->producto_view($_POST['producto']);
		$producto = array();
		$producto = $producto_view->fetch();
		if(!isset($_SESSION['tipo_user'])){

		
		//echo var_dump($producto);
?>
<section class="container">
	<br>
	<div class="row">
		<div class="col-md-6 col-lg-6 col-xl-6">
			<div class="img-container col-12">
				<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
			</div>
			<div class="img-galery">
				<div class="container">
					<div class="row">
						<div class="col-6">
							<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
						</div>
						<div class="col-6">
							<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-6 col-xl-6">
			<h3><?php echo $producto[5];?></h3>
			<!--<form>-->
				<p class="text-muted">Categoria: <?php echo $producto[1];?></p>
				<p class="text-muted">Código del Producto: <?php echo $producto[2];?></p>
				<h5><?php $tiempo =  strtotime($producto[16])-strtotime(date('Y-m-d H:i:s')); if($producto[14]>0 && $tiempo > 0){echo "Precio: S/. ".($producto[9]-(($producto[9]/100)*($producto[14]*100)));}else{echo "Precio: S/.".$producto[9];}?></h5>
				<p>Incluye delivery</p>
				<p>Descripcion: <?php echo $producto[6];?></p>
				<?php if($producto[7] != 0 && $producto[8] != 0){echo "<p>Dimenciones: ".$producto[7]." x ".$producto[8]."</p>";} ?>
				<p>Color: <?php echo $producto[10]; ?></p>
				<p class="text-muted">Estado: Disponible</p>
				<p class="text-muted">Disponibilidad: <?php echo $producto[4] ?></p>
				<label for="">Cantidad Disponible del producto: <?php echo $producto[3];?></label>
				<br>
				<label for="" style="display:inline-flex;"> <p style="margin-top:5px;margin-right:15px;">cantidad:  </p>
					<select name="cantidad" class="form-control" id="">
					<?php for($cont = 1; $cont <= $producto[3]; $cont++){echo "< option value='".$cont."'>".$cont."</option>";} ?>
					</select>
					<!--<div class="form-group">
					<p>cantidad a comprar:</p>
						<input type="number" class="form-control rounded-0" value="1">
					</div>-->
				</label>
				<div class="form-group">
					<a href="login"  class="btn btn-outline-danger rounded-0">Comprar</a>
				</div>
			<!--</form>-->
		</div>
	</div>
</section>
<?php 
		}else{
			?>
				<section class="container">
					<br>
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xl-6">
							<div class="img-container col-12">
								<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
							</div>
							<div class="img-galery">
								<div class="container">
									<div class="row">
										<div class="col-6">
											<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
										</div>
										<div class="col-6">
											<img src="<?php echo SERVERURL; ?>View/img/pd2.jpg" alt="" style="width: 100%;">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6">
							<h3><?php echo $producto[5];?></h3>
							<form action="compra" method="post">
								<input type="text" readonly name="img" style="display:none;" value="<?php echo SERVERURL; ?>View/img/pd2.jpg">
								<input type="text" readonly name="cod" style="display:none;" value="<?php echo $producto[2]; ?>">
								<input type="text" readonly name="precio" style="display:none;" value="<?php $tiempo =  strtotime($producto[16])-strtotime(date('Y-m-d H:i:s')); if($producto[14]>0 && $tiempo > 0){echo ($producto[9]-(($producto[9]/100)*($producto[14]*100)));}else{echo $producto[9];}?>">
								<input type="text" readonly name="name" style="display:none;" value="<?php echo $producto[5];?>">
								<p class="text-muted">Categoria: <?php echo $producto[1];?></p>
								<p class="text-muted">Código del Producto: <?php echo $producto[2];?></p>
								<h5><?php $tiempo =  strtotime($producto[16])-strtotime(date('Y-m-d H:i:s')); if($producto[14]>0 && $tiempo > 0){echo "Precio: S/. ".($producto[9]-(($producto[9]/100)*($producto[14]*100)));}else{echo "Precio: S/.".$producto[9];}?></h5>
								<p>Incluye delivery</p>
								<p>Descripcion: <?php echo $producto[6];?></p>
								<?php if($producto[7] != 0 && $producto[8] != 0){echo "<p>Dimenciones: ".$producto[7]." x ".$producto[8]."</p>";} ?>
								<p>Color: <?php echo $producto[10]; ?></p>
								<p class="text-muted">Estado: Disponible</p>
								<p class="text-muted">Disponibilidad: <?php echo $producto[4] ?></p>
								<label for="">Cantidad Disponible del producto: <?php echo $producto[3];?></label>
								<br>
								<label for="" style="display:inline-flex;"> <p style="margin-top:5px;margin-right:15px;">cantidad:  </p>
									<select name="cantidad" class="form-control" id="">
									<?php for($cont = 1; $cont <= $producto[3]; $cont++){echo "<option value='".$cont."'>".$cont."</option>";} ?>
									</select>
									<!--<div class="form-group">
									<p>cantidad a comprar:</p>
										<input type="number" class="form-control rounded-0" value="1">
									</div>-->
								</label>
								<div class="form-group">
									<input type="submit" value="Comprar"  class="btn btn-outline-danger rounded-0">
								</div>
							</form>
						</div>
					</div>
				</section>
			<?php
		}
}else{ header("location:".SERVERURL);}?>