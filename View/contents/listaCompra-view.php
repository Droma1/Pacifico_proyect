<?php 
        require_once "./Controller/Cliente_Controller.php";
        $perfil = new clientController();
        $datos = $perfil->perfil_cliente($_SESSION['tipo_user']);
        $date = (array) $datos->fetch();
 ?>
 <script>
$(document).ready(function(){
    $(".items-category").hide();
});
</script>
<h5>hello lista compra</h5>

<section class="container">
    <div class="card rounded-0">
        <div class="card-body">

        </div>
    </div>
</section>