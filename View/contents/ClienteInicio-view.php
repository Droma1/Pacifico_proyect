<?php
    require_once "./Controller/Cliente_Controller.php";
    $perfil = new clientController();
    $datos = $perfil->perfil_cliente($_SESSION['tipo_user']);

    $dato = (array) $datos->fetch();
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
                <b>Compras</b> <a class="pull-right">1,322</a>
            </li>
            <li class="list-group-item">
                <b>Recargas</b> <a class="pull-right">543</a>
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
                <label for="">Teléfono: <?php echo $dato[6];?></label>
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
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
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