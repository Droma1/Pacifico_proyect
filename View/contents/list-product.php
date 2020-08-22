<?php for($x = 0; $x<3;$x++){ ?>
	<br>
<section class="container" style="border: 1px solid #ffad3b;">
	<br>
	<h5>category <?php echo $x; ?></h5>
	<div class="row row-cols-1 row-cols-md-4">
	<?php for($i = 0; $i<4; $i++){?>
	  <div class="col mb-4">
	    <div class="card h-100 rounded-0">
	      <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img-top" alt="...">
	      <div class="card-body">
	        <a href="producto">
	        	<h5 class="card-title">Yogurt Gloria</h5>
	        </a>
	        <div class="card-text">
	        	<p>yogurt apropiado para las dietas y la salud</p>

	        	<span class="row">
	        		<button class="btn btn-warning"><i class="icon-basket"></i></button> 
	        		<p class="text-muted" style="margin-left: 20px; margin-top: 10px; margin-bottom: 0px;">S/. 5.00</p>
	        	</span>
	        </div>
	      </div>
	    </div>
	  </div>
	<?php } ?>
	</div>
</section>
<?php } ?>
