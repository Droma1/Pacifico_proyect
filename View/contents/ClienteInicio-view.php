<?php
    require_once "./Controller/Cliente_Controller.php";
    $perfil = new clientController();
    $datos = $perfil->perfil_cliente($_SESSION['tipo_user']);
    $contador = $perfil->contador_compras($_SESSION['tipo_user']);
    $recargas = $perfil->contador_recargas($_SESSION['tipo_user']);
    $compras = $perfil->mis_compras($_SESSION['tipo_user']);

    $dato = (array) $datos->fetch();
    if($contador->RowCount() > 0){
        $cont = (array) $contador->fetch();
    }else{
        $cont = array(0=>"0");
        //$cont[0] = "0";
    }
    if($recargas->RowCount() > 0){
        $contR = (array) $recargas->fetch();
    }else{
        $contR = array(0=>"0");
        //$cont[0] = "0";
    }
    //echo $cont[0];
    
?>
<script>
$(document).ready(function(){
    $(".items-category").hide();
});
</script>
<section class="container">

    <div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="box box-primary">
        <div class="box-body box-profile">
            <i class="d-block icon-user-circle" id="icono-usuario"></i>

            <h3 class="profile-username text-center"><?php echo $dato[0];?></h3>

            <p class="text-muted text-center"><?php echo $dato[1];?></p>

            <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Compras</b> <a class="pull-right"><?php echo $cont[0]; ?></a>
            </li>
            <li class="list-group-item">
                <b>Recargas</b> <a class="pull-right"><?php echo $contR[0]; ?></a>
            </li>
            <li class="list-group-item">
                <b>Saldo: S/. </b> <a class="pull-right"><?php echo $dato[12]; ?></a>
            </li>
            <li class="list-group-item">
                <b>Estado : </b> <a class="pull-right"><?php echo $dato[13]; ?></a>
            </li>
            </ul>
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    <br>
        <!-- About Me Box -->
        <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Mi información</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i>Dirección</strong>

            <p class="text-muted">
            <label for="">Direccion: <?php echo $dato[4];?></label>
            <label for="">Distrito: <?php echo $dato[14];?></label>
            <label for="">Provincia: <?php echo $dato[15];?></label>
            <label for="">Departamento: <?php echo $dato[16];?></label>
            </p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i>Contacto</strong>

            <p class="text-muted">
                <label for="">Teléfono: <?php echo $dato[6];?></label><br>
                <label for="">Cel: <?php echo $dato[5];?></label>
            </p>

            <hr>

            <strong><i class="fa fa-pencil margin-r-5"></i>Datos Personales</strong>

            <p class="text-muted">
            <span class="label label-danger">Sexo : <?php echo $dato[3];?></span><br>
            <span class="label label-success">Edad: <?php echo $dato[2];?></span><br>
            <span class="label label-info">Dni : <?php echo $dato[7];?></span><br>
            <span class="label label-warning">Fecha de Registro: <?php echo $dato[8];?></span>
            </p>

        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
    <br>
        <div class="card rounded-0">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active rounded-0" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Compras</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Recargas</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-0" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Configuracion</a>
                    </li>
                </ul>
                    <hr>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="col-12">
                            <br>
                            <h5>Mis Compras</h5>
                            <br>

                        </div>
                        <div class="col-12">
                            <?php 
                                        if($compras->rowCount()>0){

                                        
                                  ?> 
                            <div class="container" style="overflow:auto;">
                            <input class="form-control rounded-0" id="entrada" type="text" placeholder="Buscar mi compra">
                            <br>
                            
                            <table class="table table-striped" style="font-size:12px;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo</th>
                                    <th>Lave de compra</th>
                                    <th>Estado de la Compra</th>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>optiones</th>
                                </tr>
                                </thead>
                                <tbody id="table_producto">
                                  <?php $contador_n = 0;
                                        while($item=$compras->fetch()){
                                            $contador_n++;
                                            ?>
                                            <tr>
                                                <td><?php echo $contador_n; ?></td>
                                                <td><?php echo $item[1]; ?></td>
                                                <td><?php echo $item[2]; ?></td>
                                                <td><?php if($item[3]=="PROCESO"){echo "<p class='badge badge-warning'>".$item[3]."</p>";}else{echo "<p class='badge badge-success'>".$item[3]."</p>";} ?></td>
                                                <td>S/. <?php echo $item[4]; ?></td>
                                                <td><?php echo $item[5]; ?></td>
                                                <td><ul class="nav">

                                                    <li class="nav-item">
                                                        <p class="nav-link badge badge-info" data-toggle="modal" data-target="#modal_info<?php echo $contador_n; ?>"><i class="icon-attention-alt"></i></p>
                                                    </li>

                                                        <div class="modal fade" id="modal_info<?php echo $contador_n; ?>" tabindex="-1">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detalles de Mis Compras</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <section class="col-md-12">

                                                                <!-- Table row -->
                                                                    <div class="row">
                                                                        <div class="col-xs-12 table-responsive">
                                                                        <table class="table table-striped" style="font-size:12px;">
                                                                            <thead>
                                                                            <tr>
                                                                                <th>Nombre producto</th>
                                                                                <th>Foto</th>
                                                                                <th>Cantidad producto</th>
                                                                                <th>Precio Producto</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <?php 
                                                                                    $productos= $perfil->productos_compras($_SESSION['tipo_user'],$item[3]);
                                                                                    $sub_total = 0;

                                                                                    while($p = $productos->fetch()){
                                                                                        $sub_total = $sub_total + $p[3];
                                                                                 ?>
                                                                                <tr>
                                                                                    <td><?php echo $p[4]; ?></td>
                                                                                    <td><?php echo $p[5]; ?></td>
                                                                                    <td><?php echo $p[2]; ?></td>
                                                                                    <td><?php echo $p[3]; ?></td>
                                                                                </tr>
                                                                                    <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                        </div>
                                                                        <!-- /.col -->
                                                                    </div>
                                                                    <!-- /.row -->

                                                                    <div class="row">
                                                                        <!-- accepted payments column -->
                                                                        
                                                                        <!-- /.col -->
                                                                        <div class="col-xs-6">

                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                            <tbody><tr>
                                                                                <th style="width:50%">Subtotal:</th>
                                                                                <td>S/. <?php echo $sub_total; ?></td>
                                                                            </tr>
                                                                            </tbody></table>
                                                                        </div>
                                                                        </div>
                                                                        <!-- /.col -->
                                                                    </div>
                                                                    <!-- /.row -->
                                                                </section>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </ul>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                  ?>
                                
                                    
                                </tbody>
                            </table>
                            
                            </div>

                            <script>
                            $(document).ready(function(){
                            $("#entrada").on("keyup", function() {
                                var value = $(this).val().toLowerCase();
                                $("#table_producto tr").filter(function() {
                                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                });
                            });
                            });
                            </script>

                        <?php }else{
                            ?>
                                <div class="alert alert-light" role="alert">
                                    <center><strong>¡No a realizado compras!</strong> no se tiene registro de compras...</center>
                                </div>
                            <?php
                        }?>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        
                        <div class="col-12">
                            <h5>Mis Recargas</h5>
                            <h6 class="float-right"><strong>Saldo Actual: S/. <?php echo $dato[12]; ?></strong></h6>
                            <br>
                            <div class="form-group">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <p class="nav-link btn btn-outline-info" data-toggle="modal" data-target="#modal_add">Recargar <i class="icon-money-2"></i></p>
                                    </li>
                                    <div class="modal fade" id="modal_add" tabindex="-1">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Agregar nueva recarga</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!--<form class="FormularioAjax" data-form="save">-->
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Codigo Cliente:</label>
                                                                        <input type="text" name="cod_cliente" value="<?php echo $_SESSION['tipo_user'] ?>" id="" class="form-control rounded-0" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Monto de la recarga</label>
                                                                        <input type="number" name="monto" class="form-control rounded-0" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Boucher de Recarga:</label>
                                                                        <input type="file" name="boucher" class="form-control rounded-0" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Fecha de la Recarga</label>
                                                                        <input type="text" name="" class="form-control rounded-0" value="<?php echo date('Y-m-d H:i:s'); ?>" id="" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="card">
                                                                        <div class="card-body"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="button" class="btn btn-primary">Guardar Cambios</button>
                                                            <div class="RespuestaAjax"></div>
                                                        </div>
                                                    <!--</form>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                        <?php 
                            $recarga = $perfil->recargas($_SESSION['tipo_user']);
                            if($recarga->rowCount() > 0){ $contador_r = 0;
                        ?>
                            <div class="container table-responsive">
                                <input class="form-control" id="entrada" type="text" placeholder="Buscar en la tabla">
                                <br>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Monto</th>
                                            <th>Estado</th>
                                            <th>Fecha de Recarga</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_producto">
                                        <?php while($re = $recarga->fetch()){ $contador_r++;?>
                                        <tr>
                                            <td><?php echo $contador_r; ?></td>
                                            <td>S/. <?php echo $re[1]; ?></td>
                                            <td><?php if($re[3]=="PROCESO"){echo "<p class='badge badge-warning'>".$re[3]."</p>";}else{echo "<p class='badge badge-success'>".$re[3]."</p>";} ?></td>
                                            <td><?php echo $re[4]; ?></td>
                                            <td><ul class="nav">
                                                <li class="nav-item">
                                                    <p class="nav-link badge badge-info" data-toggle="modal" data-target="#modal_recarga<?php echo $contador_r; ?>"><i class="icon-attention-alt"></i></p>
                                                </li>
                                                    <div class="modal fade" id="modal_recarga<?php echo $contador_r; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Info Repartidores</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="">Codigo Cliente:</label>
                                                                            <label for=""><?php echo $re[0]; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Monto de la Recarga: </label>
                                                                            <label for="">S/. <?php echo $re[1]; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Estado de la Recarga:</label>
                                                                            <label for=""><?php echo $re[3]; ?></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Fecha de la Recarga:</label>
                                                                            <label for=""><?php echo $re[4]; ?></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="card">
                                                                            <div class="card-body"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            
                            </div>

                            <script>
                            $(document).ready(function(){
                                $("#entrada").on("keyup", function() {
                                    var value = $(this).val().toLowerCase();
                                    $("#table_producto tr").filter(function() {
                                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                    });
                                });
                            });
                            </script>
                            <?php }else{
                                ?>
                                <div class="alert alert-light" role="alert">
                                    <center><strong>¡No a realizado Recargas!</strong> Recarge su cuenta para realizar compras...</center>
                                </div>
                                <?php
                            }?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="col-12">
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Nombre: </label>
                                            <input type="text" class="form-control rounded-0" value="<?php echo $dato[0]; ?>"  placeholder="Nombre...">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Apellidos: </label>
                                            <input type="text" class="form-control rounded-0" value="<?php echo $dato[1]; ?>" placeholder="Apellios...">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Edad :</label>
                                            <input type="number" value="<?php echo $dato[2]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Sexo: <?php echo $dato[3]; ?></label>
                                            <select name="" id="" class="form-control rounded-0">
                                                <option value="0">...</option>
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMENINO">FEMENINO</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Direccion: </label>
                                            <input type="text" value="<?php echo $dato[4]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Nro. de Cel. :</label>
                                            <input type="text" value="<?php echo $dato[5]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Nro. de Tel. :</label>
                                            <input type="text" value="<?php echo $dato[6]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">DNI :</label>
                                            <input type="text" value="<?php echo $dato[7]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Fecha de Registro :</label>
                                            <p class="text-muted form-control rounded-0" readonly><?php echo $dato[8]; ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Usuario :</label>
                                            <input type="text" value="<?php echo $dato[9]; ?>" class="form-control rounded-0">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Contraseña :</label>
                                                <input type="text" class="form-control rounded-0">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-outline-success rounded-0" value="Guardar Cambios">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.col -->
    </div>
<!-- /.row -->

</section>