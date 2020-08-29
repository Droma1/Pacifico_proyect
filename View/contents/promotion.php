<?php 
require_once "./Controller/listarProductoController.php";
$promotion = new productoController_l();
$lista_promo = $promotion->promociones();
$contador = 0;
 ?>
<section class="container">
	<br>
	<h6><a href="promotion">Promociones de la semana</a></h6>
	<br>
	<div class="row row-cols-1 row-cols-md-4">
	<?php while(($promo_p = $lista_promo->fetch()) && $contador <= 3){
		
		$tiempo =  strtotime($promo_p[5])-strtotime(date('Y-m-d H:i:s'));
			if($tiempo>0){
				$contador++;
		?>
	  <div class="col mb-4">
	    <div class="card h-100 rounded-0">
	      <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img-top" alt="...">
	      <div class="card-body">
	        <a href="producto">
	        	<h5 class="card-title"><?php echo $promo_p[0]; ?><span class="badge badge-danger float-right" style="border-radius: 0px; font-size: 12px;">  %<?php echo ($promo_p[2])*100; ?></span></h5>
	        </a>
	        <p class="card-text">

	        	<p class="text-muted"> expira en : <?php echo date("dS H:i",$tiempo); ?></p>
	        </p>
	      </div>
	    </div>
	  </div>
	<?php  }} ?>
	</div>
</section>