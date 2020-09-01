<?php 
require_once "./Controller/listarProductoController.php";
$promotion = new productoController_l();
$lista_promo = $promotion->promociones();
 ?>
<section class="container" style="background-color: #FFF;">
	<br>
	<br>
	<div class="row row-cols-1 row-cols-md-4">
	<?php while(($promo_p = $lista_promo->fetch())){
		
		$tiempo =  strtotime($promo_p[5])-strtotime(date('Y-m-d H:i:s'));
			if($tiempo>0){
				?>
	  <div class="col mb-4">
	    <div class="card h-100 rounded-0">
	      <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img-top" alt="...">
	      <div class="card-body">
	        <a href="producto">
	        	<h5 class="card-title"><?php echo $promo_p[0]; ?>  <span class="badge badge-danger" style="border-radius: 0px; font-size: 12px;">-<?php echo $promo_p[2]*100; ?>%</span></h5>
	        </a>
	        <p class="card-text">

	        	<p class="text-muted">expire: <?php echo date("dS H:i",$tiempo); ?></p>
	        	<span class="row">
	        		<button class="btn btn-outline-warning rounded-0"><i class="icon-basket"></i></button> 
	        		<p class="text-muted" style="margin-left: 20px; margin-top: 10px; margin-bottom: 0px;"><strong>S/. <?php $dato = $promo_p[6]-(($promo_p[6]/100)*($promo_p[2]*100)); echo $dato; ?></strong>  antes: <s style="font-size: 12px;">s/. <?php echo $promo_p[6]; ?></s></p>
	        	</span>
	        </p>
	      </div>
	    </div>
	  </div>
	<?php }} ?>
	</div>
</section>