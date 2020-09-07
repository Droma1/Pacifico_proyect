<?php 
        require_once "./Controller/Cliente_Controller.php";
        $perfil = new clientController();
        $datos = $perfil->perfil_cliente($_SESSION['tipo_user']);
        $date = (array) $datos->fetch();
 ?>
<br>
<script>
$(document).ready(function(){
    $(".items-category").hide();
});
</script>
<section class="container">
    <div class="col-md-12">
        <div class="card rounded-0">
            <div class="card-header">
                <h6>Comprar producto</h6>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Nombre del Cliente: <p class="text-muted"><?php echo $date[0]; ?></p></label>
                            </div>
                            <div class="form-group">   
                                <label for="">Apellidos del Cliente: <p class="text-muted"><?php echo $date[1]; ?></p></label>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">DNI del Cliente: <p class="text-muted"><?php echo $date[7]; ?></p></label>
                            </div>
                            <div class="form-group">
                                    <label for="">Nro Cel: <p class="text-muted"><?php echo $date[5]; ?></p></label>
                            </div>
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Direccion: <p class="text-muted"><?php echo $date[4]; ?></p></label>
                                </div>
                                <div class="form-group">   
                                    <label for="">Distrito: <p class="text-muted"><?php echo $date[14]; ?></p></label>
                                </div>
                                
                        </div>
                        <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Provincia: <p class="text-muted"><?php echo $date[15]; ?></p></label>
                                </div>
                                <div class="form-group">
                                    <label for="">Departamento: <p class="text-muted"><?php echo $date[16]; ?></p></label>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="overflow:auto;">
                    <table class="table table-stripet">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="<?php echo $_POST['img'];?>" alt="" style="width:100px;height:100px;"></td>
                                    <td><?php echo $_POST['name'];?></td>
                                    <td>S/. <?php echo $_POST['precio'];?></td>
                                    <td><?php echo $_POST['cantidad'];?></td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table class="table">
                        <tbody><tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>S/. <?php echo $_POST['precio']*$_POST['cantidad']; ?></td>
                        </tr>
                    </tbody></table>
                </div>
                <hr>
                <div class="col-md-12">
                    <form action="formularioAjax" method="post">
                        <div class="row">
                            <div style="display:none;">
                                <input type="text" name="cod_cliente" value="<?php echo $date['11'];?>" id="">
                                <input type="text" name="monto_c" value="<?php echo $_POST['precio']*$_POST['cantidad'];?>" id="">
                                <input type="text" name="fecha_c" value="<?php echo date('Y-m-d H:i:s');?>" id="">
                                <input type="text" name="cant" value="<?php echo $_POST['cantidad'];?>">
                                <input type="text" name="cod_producto" value="<?php echo $_POST['cod'];?>">
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-success rounded-0" value="Realizar Compra">
                                </div>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
