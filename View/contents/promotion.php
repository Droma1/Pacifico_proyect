<section class="container">
	<br>
	<h6><a href="promotion">Promociones de la semana</a></h6>
	<br>
	<div class="row row-cols-1 row-cols-md-4">
	<?php for($i = 0; $i<4; $i++){?>
	  <div class="col mb-4">
	    <div class="card h-100 rounded-0">
	      <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img-top" alt="...">
	      <div class="card-body">
	        <a href="producto">
	        	<h5 class="card-title">Yogurt Gloria  <span class="badge badge-danger" style="border-radius: 0px; font-size: 12px;">-15%</span></h5>
	        </a>
	        <p class="card-text">

	        	<p class="text-muted">expire: weekend</p>
	        </p>
	      </div>
	    </div>
	  </div>
	<?php } ?>
	</div>
</section>