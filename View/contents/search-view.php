<!--<h5>hello su busqueda es : <?php //echo $_POST['search'];?></h5>-->
<?php if(isset($_POST['search'])){
        require_once "./Controller/listarProductoController.php";
        $search_b = new productoController_l();
        //echo $_POST['search'];
        $search_e = $search_b->producto_search($_POST['search']);
        /*echo var_dump($search_e->fetch());
        while($row = $search_e->fetch()){
            echo var_dump($row);
        }
        echo $search_e->fetch();*/
        //echo var_dump($producto);
        if($search_e->rowCount()>0){
            //echo "encontrado";
        
?>
<section class="container">
    <ul class="list-group list-group-flush">
        <?php while($resultados_search = $search_e->fetch()){ ?>
        <li class="list-group-item">
            <div class="mb-1 rounded-0" >
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo SERVERURL; ?>/View/img/pd2.jpg" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <form action="producto" method="post">
                                <button class="text-title title_promotion" name="producto" id="producto" value="<?php echo $resultados_search[2];?>">
                                    <h5 class="card-title"><?php echo $resultados_search[5]; ?></h5>
                                </button>
                            </form>
                            <p class="catd-text">Categoria: <?php echo $resultados_search[5];?></p>
                            <p class="card-text">Codigo del Producto: <?php echo $resultados_search[2];?></p>
                            <p class="card-text"><?php echo $resultados_search[6];?></p>
                            <p class="card-text"><small class="text-muted">precio: S/. <?php echo $resultados_search[7];?></small></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <?php }?>
    </ul>
</section>
<?php
    }else{?>
        <section class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:15%;text-align:center;">
            <br>
                <center>
                        <i style="font-size: 50px;" class="icon-emo-cry"></i>
                </center>
                <strong>Problemas!</strong>Búsqueda no encontrada el producto que intentas buscar no se encuentra dentro de nuestra base de datos!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
            </div>
        </section>
   <?php }
 }else{ ?>
    <section class="container">
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:15%;text-align:center;">
        <br>
            <center>
                    <i style="font-size: 50px;" class="icon-emo-cry"></i>
            </center>
            <strong>Problemas!</strong>No se realizó ninguna peticion de búsqueda! por favor ingrese lo que desea buscar!.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <br>
        </div>
    </section>
    <?php }?>