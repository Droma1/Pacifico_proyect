<section class="container" style="position:relative; z-index: 11; background-color: #fff;">
<br>
        <br>
    
        <form action="" data-form="" method="POST" class="logForm" autocomplete="off">
        <div class="row justify-content-md-center">
            <div class="col-md-6 card">
            <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">Correo Electronico</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="usuario_log" aria-describedby="emailHelp" placeholder="Ingresar email">
                    <small id="emailHelp" class="form-text text-muted">Acceda con su cuenta con el correo que se registro.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="pass" name="clave_log" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="eye">
                    <label class="form-check-label" for="eye" id="text_eye">Mostrar password</label>
                    <input type="checkbox" class="form-check-input" id="eye2">
                    <label class="form-check-label" for="eye2" id="text_eye2">Ocultar password</label>
                </div>
                <br>
                <div class="form-group">
                    <a href="RegistroCliente">¿No tienes una cuenta? Registrate.</a>
                </div>
                <br>
                    <button type="submit" style="background:#ff9600;" class="btn">Ingresar</button>
                    <br>
            </div>
            
            </div>
            <div class="RespuestaAjax"></div>
        </form>
        <?php
            if(isset($_POST['usuario_log']) && isset($_POST['clave_log'])){
                require_once "./Controller/logController.php";
                $log = new logController();
                echo $log->log_Controller();	
            }
        ?>
    <br>
</section>
