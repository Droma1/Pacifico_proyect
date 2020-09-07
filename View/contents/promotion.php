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
	    <div class="card h-100  bg-danger text-white rounded-0">
	      <img src="<?php echo SERVERURL; ?>View/imgp/<?php echo $promo_p[1];?>" class="card-img rounded-0" style="max-height:200px;" alt="...">
		  
	      <div class="card-img-overlay rounded-0" >
			
	        
	        <div class="card-text" style="position: absolute;
					background-color: rgb(255 98 98 / 52%);
					width: 100%;
					height: 64px;
					text-align: center;
					left: 0px;
					top: 60%;">
				<form action="producto" method="post">
					<button class="text-title title_promotion" name="producto" value="<?php echo $promo_p[3];?>"><h5 class="card-title"><?php echo $promo_p[0]; ?><span class="badge badge-danger float-right" style="border-radius: 0px; font-size: 12px;">  %<?php echo ($promo_p[2])*100; ?></span></h5></button>
				</form>
	        	<p class="text-withe"> expira en : <?php echo date("dS H:i",$tiempo); ?></p>
	        </div>
	      </div>
	    </div>
	  </div>
	<?php  }} ?>
	</div>
</section>