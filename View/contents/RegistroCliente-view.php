<section class="container">
    <div class="col-md-12">
    <br>
        <div class="card card-default">
            <div class="card-body">
                <form action="<?php echo SERVERURL; ?>Ajax/clienteAjax.php" data-form="" method="POST" class="formAjax" autocomplete="off" enctype="multipart/from-data">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nombre_c">Nombres:</label>
                                <input class="form-control" type="text" name="nombre_cliente" id="nombre_c" placeholder="Ingrese su Nombre">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="apellidos_c">Apellidos:</label>
                                <input class="form-control" type="text" name="apellido_cliente" id="apellidos_c" placeholder="Ingrese sus apellidos">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="edad_c">Edad:</label>
                                <input class="form-control" type="number" min="1" max="99" maxlength="2" name="edad_cliente" id="edad_c" placeholder="Ingrese su Edad">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <select class="form-control" name="optionSexo" id="sexo">
                                    <option value="otro">No Mencionar</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label style="overflow:hidden;" for="direccion_p"><p style="float:left;margin:0px;">Dirección :</p><i style="float: left;margin:0px;" class="form-text text-muted">Opcional</i></label>                            
                                <input class="form-control" type="text" name="direccion_cliente" id="direccion_p" placeholder="Direccion donde se encuentra">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                            <label for="nro_cel">Número de Celular:</label>
                                <input class="form-control" type="number" max="999999999" maxlength="9" id="nro_cel" name="cel_cliente" placeholder="Ingrese su numero de Cel">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="nro_tel">Número de Teléfono:</label>
                                <input class="form-control" type="number" max="999999999" maxlength="9" id="nro_tel" name="tel_cliente" placeholder="Ingrese su numero de Tel">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                            <label for="dni">DNI:</label>
                                <input class="form-control" type="number" max="99999999" maxlength="8" id="dni" name="dni_cliente" placeholder="Número de DNI">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                            <label for="correo">Correo Electrónico :</label>
                                <input class="form-control" name="email_cliente" id="correo" type="email" placeholder="Example@example.com">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                            <label for="clave">Clave de Cuenta :</label>
                                <input class="form-control" name="clave_cliente1" id="clave" type="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                            <label for="clave_c">Confirmar Clave de Cuenta :</label>
                                <input class="form-control" name="clave_cliente2" id="clave_c" type="password" placeholder="Password confirm">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check">
                                    <label class="form-check-label form-text text-muted" for="check" id="check_text">Acepto los 
                                        <a href="terminos">Terminos y condiciones</a> y las <a href="politicas">Politicas de Privacidad</a> de Pacífico supermercados
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="Registrar">
                            </div>
                        </div>
                        
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
                
            </div>
        </div>
    </div>
    <br>
</section>