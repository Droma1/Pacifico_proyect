
	<?php
	require_once "./Controller/listarProductoController.php";
	$product = new productoController_l();
	$categorias_p = $product->listar_categoria();
?>

<?php
	//echo "como es?";
	foreach($categorias_p as $categorias => $x_categorie){
		$l_producto = $product->listar_producto($x_categorie[1]);
		//echo "<br>";
		//echo var_dump($x_categorie);
		//echo "<br>";
		$contador = 0;
	?>
		<br>
	<section class="container" style="border: 1px solid #ffad3b;">
		<br>
		<h5><?php echo $x_categorie[0]; ?></h5>
		<div class="row row-cols-1 row-cols-md-4">
		
		<?php ;while(($producto = $l_producto->fetch()) && $contador<=3){ $contador++;?>
		<div class="col mb-4">
			<div class="card h-100 rounded-0">
			<img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $producto[8]; ?>" class="card-img-top" alt="...">
			<div class="card-body">
					<form action="producto" method="post">
						<button class="text-title title_promotion" name="producto" value="<?php echo $producto[2];?>">
							<h5 class="card-title"><?php echo $producto[5]; ?></h5>
						</button>
					</form>
				
				<div class="card-text">
					<p><?php echo $producto[6];?></p>

					<span class="row">
						<a class="agregar-carrito btn btn-warning icon-basket" data-id="<?php echo $producto[0]."-".$contador;?>">
						</a> 
						<p class="text-muted" style="margin-left: 20px; margin-top: 10px; margin-bottom: 0px;">S/. <span><?php echo $producto[7];?></span> </p>
					</span>
				</div>
			</div>
			</div>
		</div>
		<?php } ?>
		</div>
	</section>

<?php } ?>
