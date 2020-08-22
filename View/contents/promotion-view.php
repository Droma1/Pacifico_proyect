<section class="container" style="background-color: #FFF;">
	<br>
	<br>
	<div class="row row-cols-1 row-cols-md-4">
	<?php for($i = 0; $i<20; $i++){?>
	  <div class="col mb-4">
	    <div class="card h-100 rounded-0">
	      <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img-top" alt="...">
	      <div class="card-body">
	        <a href="producto">
	        	<h5 class="card-title">Yogurt Gloria  <span class="badge badge-danger" style="border-radius: 0px; font-size: 12px;">-<?php echo $i + 15; ?>%</span></h5>
	        </a>
	        <p class="card-text">

	        	<p class="text-muted">expire: weekend</p>
	        	<span class="row">
	        		<button class="btn btn-outline-warning rounded-0"><i class="icon-basket"></i></button> 
	        		<p class="text-muted" style="margin-left: 20px; margin-top: 10px; margin-bottom: 0px;">S/. <?php echo $pr= 5-(((15+$i)*5)/100); ?></p>
	        	</span>
	        </p>
	      </div>
	    </div>
	  </div>
	<?php } ?>
	</div>
</section>